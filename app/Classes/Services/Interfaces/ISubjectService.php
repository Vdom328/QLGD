<?php

namespace App\Classes\Services\Interfaces;

interface ISubjectService
{
    /**
     * radom subject no
     */
    public function randomNo();

    /**
     * create new instance
     * @param array $data
     */
    public function createNewData($data);

    /**
     * filter data
     * @param array $data
     */
    public function filter($data);

    /**
     * find data by id
     * @param int $id
     */
    public function findById($id);

    /**
     * save update data
     * @param array $data
     */
    public function saveUpdate($data);
}
