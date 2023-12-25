<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use jeremykenedy\LaravelRoles\Models\Role as OriginRole;

class Role extends OriginRole
{
    use HasFactory;
    protected $guarded = [];
}
