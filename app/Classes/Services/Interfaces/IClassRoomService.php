<?php

namespace App\Classes\Services\Interfaces;

interface IClassRoomService
{
    /**
     * find data
     * @param array $data
     */
    public function filter($data);

    /**
     * create a new classroom
     * @param array $data
     */
    public function createNewData($data);
}
