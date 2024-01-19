<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherSubject extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'teacher_subjects';
    protected $guarded = [];

    public function subject()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id')->withTrashed();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id')->withTrashed();
    }
    public function class()
    {
        return $this->hasOne(ClassModel::class, 'id', 'class_id')->withTrashed();
    }
}
