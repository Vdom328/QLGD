<?php

namespace App\Classes\Repository;

use App\Classes\Enum\StaffStatusEnum;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function filterStaffs($data)
    {
        if ($data == 1) {
            $query = $this->model->where('status', $data)->paginate(Config::get('const.pagination'));
        } else {
            $query = $this->model->paginate(Config::get('const.pagination'));
        }
        return $query;
    }

    /**
     * @inheritdoc
     */
    public function sortStaffs($column, $direction)
    {
        return $this->model
            ->with(['profile', 'roles'])
            ->select('users.*', 'profiles.staff_no', DB::raw('CONCAT(profiles.first_name, " ", profiles.last_name) AS name'))
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->orderBy($column, $direction)
            ->paginate(Config::get('const.pagination'));
    }

    public function getListStaffs($data)
    {
        $column = $data['column'] ?? null;
        $direction = $data['direction'] ?? null;

        $query = $this->model
            ->with(['profile', 'roles'])
            ->select('users.*', 'profiles.staff_no', DB::raw('CONCAT(profiles.first_name, " ", profiles.last_name) AS name'))
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->leftJoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftJoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->orderBy($column ?? 'id', $direction ?? 'asc');

        if (isset($data['filter'])) {
            $query = $query->where('status', StaffStatusEnum::VALID);
        }

        $staffs = $query->paginate(Config::get('const.pagination'));

        $attr = [
            'column' => $column,
            'direction' => $direction,
            'staffs' => $staffs,
        ];
        return $attr;
    }
}
