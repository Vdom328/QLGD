<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoAttachments extends Model
{
    use HasFactory;
    protected $table = 'todo_attachments';

    protected $guarded = [];

    public function todo()
    {
        return $this->belongsTo(Todo::class, 'todo_id');
    }
}
