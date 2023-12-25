<?php

namespace App\Classes\Repository\Interfaces;

interface ITodoRepository extends IBaseRepository
{
    public function getAllData();
    public function dataFilter($data);
}
