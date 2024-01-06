<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleError extends Model
{
    use HasFactory;
    protected $table = 'schedule_error';
    protected $guarded = [];
}
