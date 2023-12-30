<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = 'subjects';
    protected $guarded = [];

    public function subject_labs()
    {
        return $this->belongsTo(SubjectLabs::class, 'id', 'subject_id');
    }
}
