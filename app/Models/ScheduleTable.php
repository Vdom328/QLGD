<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTable extends Model
{
    use HasFactory;
    protected $table = 'schedule_table';
    protected $guarded = [];
    public function teacher_subject()
    {
        return $this->hasOne(TeacherSubject::class, 'id', 'teacher_subjects_id');
    }

    public function class_room()
    {
        return $this->hasOne(ClassRoom::class, 'id', 'class_room_id');
    }
}
