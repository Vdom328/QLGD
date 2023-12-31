<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\IUserService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Implement UserService
 */
class UserService extends BaseService implements IUserService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function getListStaffs($data)
    {
        return $this->userRepository->getListStaffs($data);
    }

    /**
     * @inheritdoc
     */
    public function filterStaffs($data)
    {
        return $this->userRepository->filterStaffs($data);
    }

    /**
     * @inheritdoc
     */
    public function finById($id)
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @inheritdoc
     */
    public function sortStaffs($column, $direction)
    {
        return $this->userRepository->sortStaffs($column, $direction);
    }

    /**
     * @inheritdoc
     */
    public function getListUser()
    {
        return $this->userRepository->find();
    }

    /**
     * @inheritdoc
     */
    public function getUserByEmail($email)
    {
        return $this->userRepository->findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function filter($data)
    {
        return $this->userRepository->filter($data);
    }
}
