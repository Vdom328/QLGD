<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRelatedFile extends Model
{
    use HasFactory;

    protected $table = 'project_related_files';

    protected $guarded = [];
}
