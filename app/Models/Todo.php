<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todos';

    protected $guarded = [];

    public function todo_attachments()
    {
        return $this->hasMany(TodoAttachments::class, 'todo_id');
    }

    public function manager()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'manager_id');
    }


    public function registrar()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'registrar_id');
    }

    public function project()
    {
        return $this->hasOne(\App\Models\Project::class, 'id', 'project_id');
    }

    public function isExpired()
    {
        return $this->expired_date <= Carbon::now();
    }
}
