<?php

namespace App\Classes\Services\Interfaces;

interface IProfileService
{
    /**
     * update profile by user_id
     * update user by id
     * update user notification by user_id
     * @param array $data
     * @return bool
     */
    public function updateProfileOrCreateProfile($data);

    public function radomStaffNo();
}
