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
        IUserNotificationRepository $userNotificationRepository,
        IRoleUserRepository $roleUserRepository
    ) {
        $this->profileRepository = $profileRepository;
        $this->userRepository = $userRepository;
        $this->userNotificationRepository = $userNotificationRepository;
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
                "kana_first_name" => $data['kana_first_name'],
                "kana_last_name" => $data['kana_last_name'],
                "phone" => $data['phone'],
                "sub_email" => $data['sub_email'],
                "is_notification_main_email" => isset($data['is_notification_main_email']) ? $data['is_notification_main_email'] : Config::get('const.profile.no'),
                "is_notification_sub_email" => isset($data['is_notification_sub_email']) ? $data['is_notification_sub_email'] : Config::get('const.profile.no'),
                "avatar" => $avatar,
            ];
            if ($profile) {
                $newProfile = $this->profileRepository->update($profile, $attrProfile);
            } else {
                $newProfile = $this->profileRepository->create($attrProfile);
            }

            // update user notification by user_id
            $userNotification = $this->userNotificationRepository->findOne(['user_id' => $data['id']]);
            $attrUserNotification = [
                "user_id" => $data['id'],
                "todo_add_new_person_in_charge" => isset($data['todo_add_new_person_in_charge']) ? $data['todo_add_new_person_in_charge'] : Config::get('const.user_notification_setting.no'),
                "todo_expire_date" => isset($data['todo_expire_date']) ? $data['todo_expire_date'] : Config::get('const.user_notification_setting.no'),
                "todo_add_new" => isset($data['todo_add_new']) ? $data['todo_add_new'] : Config::get('const.user_notification_setting.no'),
                "before_invoice_due_date" => isset($data['before_invoice_due_date']) ? $data['before_invoice_due_date'] : Config::get('const.user_notification_setting.no'),
                "deposit_withdrawal_alert" => isset($data['deposit_withdrawal_alert']) ? $data['deposit_withdrawal_alert'] : Config::get('const.user_notification_setting.no'),
                "driver_information_not_sent" => isset($data['driver_information_not_sent']) ? $data['driver_information_not_sent'] : Config::get('const.user_notification_setting.no'),
                "before_QB_final_confirmation_deadline" => isset($data['before_QB_final_confirmation_deadline']) ? $data['before_QB_final_confirmation_deadline'] : Config::get('const.user_notification_setting.no'),
                "before_QB_specification_deadline" => isset($data['before_QB_specification_deadline']) ? $data['before_QB_specification_deadline'] : Config::get('const.user_notification_setting.no'),
            ];
            if ($userNotification) {
                $userNotification = $this->userNotificationRepository->update($userNotification, $attrUserNotification);
            } else {
                $userNotification = $this->userNotificationRepository->create($attrUserNotification);
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
