<?php

namespace App\Classes\Services;

use App\Classes\Enum\StaffStatusEnum;
use App\Classes\Repository\Interfaces\IProfileRepository;
use App\Classes\Repository\Interfaces\IRoleRepository;
use App\Classes\Repository\Interfaces\IRoleUserRepository;
use App\Classes\Repository\Interfaces\IUserNotificationRepository;
use App\Classes\Repository\Interfaces\IUserRepository;
use App\Classes\Services\Interfaces\IProfileService;
use App\Models\Profile;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Implement UserService
 */
class ProfileService extends BaseService implements IProfileService
{
    private $profileRepository, $userRepository, $userNotificationRepository, $roleUserRepository;

    public function __construct(
        IProfileRepository $profileRepository,
        IUserRepository $userRepository,
        IRoleUserRepository $roleUserRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->roleUserRepository = $roleUserRepository;
    }

    /**
     * @inheritDoc
     */
    public function updateProfileOrCreateProfile($data)
    {
        DB::beginTransaction();
        try {
            $user = null;
            if ($data['id']) {
                $user = $this->userRepository->findById($data['id']);
            }

            // update user by $id
            if ($data['password'] === '' || $data['password'] === null || $data['password'] == false) {
                $password = $user->password;
            } else {
                $password = Hash::make($data['password']);
            }

            $attrUser = [
                'email' => $data['email'],
                'password' => $password,
                'status' => isset($data['status']) ? $data['status'] : StaffStatusEnum::INVALID->value,
            ];

            if (!$user) {
                $attrUser['token'] = str_random(64);
                $newUser = $this->userRepository->create($attrUser);
                $data['id'] = $newUser->id;
            } else {
                $user = $this->userRepository->update($user, $attrUser);
            }

            // update role
            $roleUser = $this->roleUserRepository->findOne(['user_id' => $data['id']]);
            $attrRole = [
                "user_id" => $data['id'],
                "role_id" => $data['role'],
            ];
            if ($roleUser) {
                $newRole = $this->roleUserRepository->update($roleUser, $attrRole);
            } else {
                $newRole = $this->roleUserRepository->create($attrRole);
            }

            // update profile by user_id
            $avatar = null;
            $profile = $this->profileRepository->findOne(['user_id' => $data['id']]);
            if ($profile) {
                $avatar = $profile->avatar;
            }
            if (isset($data['avatar']) && ($data['avatar'] != '' || $data['avatar'] != null ) &&  $avatar != $data['avatar'] ) {
                if ($profile ) {
                    Storage::delete('public/avatarUser/' . $profile->avatar);
                }
                $imageName = uniqid() . '.' . $data['avatar']->extension();
                $data['avatar']->storeAs('public/avatarUser/', $imageName);
                $avatar = $imageName;
            }
            $attrProfile = [
                "user_id" => $data['id'],
                "staff_no" => isset($data['staff_no']) ? $data['staff_no'] : ($profile->staff_no ?? null),
                "first_name" => $data['first_name'],
                "last_name" => $data['last_name'],
                "phone" => $data['phone'],
                "avatar" => $avatar,
            ];
            if ($profile) {
                $newProfile = $this->profileRepository->update($profile, $attrProfile);
            } else {
                $newProfile = $this->profileRepository->create($attrProfile);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error while updating or creating user profile: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * radom staff no
     */
    public function radomStaffNo()
    {
        for ($staffNo = 1; $staffNo <= 9999; $staffNo++) {
            $exists = $this->profileRepository->exists($staffNo);
            if (!$exists) {
                return str_pad($staffNo, 4, '0', STR_PAD_LEFT);
            }
        }
        return $staffNo;
    }
}
