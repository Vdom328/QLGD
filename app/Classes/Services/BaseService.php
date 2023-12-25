<?php

namespace App\Classes\Services;

use Illuminate\Support\Facades\DB;

abstract class BaseService
{
    public static function beginTransaction()
    {
        DB::beginTransaction();
    }

    public static function commit()
    {
        DB::commit();
    }

    public static function rollback()
    { 
        DB::rollBack();
    }
}
