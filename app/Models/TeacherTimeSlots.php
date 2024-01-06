<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherTimeSlots extends Model
{
    use HasFactory;
    protected $table = 'teacher_time_slots';
    protected $guarded = [];
}
