<?php

namespace App\Traits;

use App\Observers\ModelSignature;

trait RecordSignature
{
    public static function bootRecordSignature()
    {
        static::observe(new ModelSignature);
    }
}
