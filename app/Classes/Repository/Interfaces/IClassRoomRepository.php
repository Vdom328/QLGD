<?php

namespace App\Classes\Repository\Interfaces;

interface IClassRoomRepository extends IBaseRepository
{
    /**
     * find data
     * @param array $data
     */
    public function filter($data);
}
