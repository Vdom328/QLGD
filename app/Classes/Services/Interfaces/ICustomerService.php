<?php

namespace App\Classes\Services\Interfaces;


interface ICustomerService
{
    public function getAllCustomer();

    /**
     * get list data
     * @return mixed
     */
    public function getListCustomer($data);

    /**
     * random customer code
     */
    public function radomCustomerCode();


    /**
     * post create customer
     * @param array $data
     * @return bool
     */
    public function saveCreate($data);

    /**
     * find customer by id
     * @param int $id
     */
    public function findById($id);

     /**
     * update customer by id
     * @param int $id
     * @param array $data
     */
    public function updateCustomerById($data,$id);

    public function find(array $conditions = []);

    /**
     * get customers by "staff_id" in Customer Manager
     */
    public function getByStaffIdInCustomerManager($staffId);

    /**
     * delete customer by id
     * @param int $id
     */
    public function delete($id);
}
