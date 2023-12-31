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

    /**
     * find bu id
     * @param int $id
     */
    public function findById($id);

    /**
     * save update data
     * @param array $data
     */
    public function saveUpdate($data);


    /**
     * delete by id
     * @param int $id
     */
    public function deleteById($id);
}
