<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IUserNotificationRepository;
use App\Models\UserNotificationSetting;

class UserNotificationRepository  extends BaseRepository implements IUserNotificationRepository
{
    public function __construct(UserNotificationSetting $model)
    {
        parent::__construct($model);
    }
}
