<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $guarded = [];

    public function schedule_table()
    {
        return $this->hasMany(ScheduleTable::class, 'schedule_id');
    }

    public function schedule_error()
    {
        return $this->hasMany(ScheduleError::class, 'schedule_id');
    }
}
