<?php

namespace App\Classes\Services\Interfaces;


interface ITodoService
{

    /**
     * create todo
     * @param array $data
     */
    public function createData($data);

    /**
     * get all todo
     */
    public function getAllData();

    /**
     * find todo by id
     * @param int $id
     */
    public function findById($id);

    /**
     * update todo bu id
     * @param array $data
     * @param int $id
     */
    public function saveUpdate($data, $id);

    /**
     * sort and filter data
     * @param array $data
     */
    public function dataFilter($data);

    /**
     * delete todo by id
     * @param int  $id
     */
    public function delete($id);
}
