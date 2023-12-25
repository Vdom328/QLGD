<?php

namespace App\Classes\Repository\Interfaces;

interface IProfileRepository extends IBaseRepository
{
    public function exists($staffNo);
}
