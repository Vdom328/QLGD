<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    use HasFactory;

    protected $table = 'user_notification_setting';

    protected $guarded = [];

    /**
     * A user notification setting belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
