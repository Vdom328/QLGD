<?php

namespace App\Classes\Repository\Interfaces;

interface IClassRepository extends IBaseRepository
{
    /**
     * find data
     * @param array $data
     */
    public function filter($data);
}
