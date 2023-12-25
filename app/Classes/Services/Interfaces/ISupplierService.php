<?php

namespace App\Classes\Services\Interfaces;


interface ISupplierService
{
    /**
     * get list data
     * @return mixed
     */
    public function getListSupplier($data);

    /**
     * post create supplier
     * @param array $data
     * @return bool
     */
    public function saveCreate($data);

     /**
     * random supplier code
     *
     */
    public function radomSupplierCode();

    /**
     * get list data sort by column
     * @param array $data
     */
    public function sortSupplier($data);

    /**
     * find supplier by id
     * @param int $id
     */
    public function findById($id);


    /**
     * update supplier by id
     * @param int $id
     * @param array $data
     */
    public function updateSupplierById($data,$id);


    /**
     * get all supplier
     */
    public function getAllSupplier();

    /**
     *delete supplier by id
     * @param int $id
     */
    public function delete($id);


}
