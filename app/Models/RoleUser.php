<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;
    protected $table = 'role_user';
    protected $guarded = [];

    public function role()
    {
        return $this->hasOne(\App\Models\Role::class, 'id', 'role_id');
    }
}
