<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;
    protected $table = 'student_subject';
    protected $guarded = [];

    public function teacher_subject()
    {
        return $this->hasOne(TeacherSubject::class, 'id', 'teacher_subject_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
