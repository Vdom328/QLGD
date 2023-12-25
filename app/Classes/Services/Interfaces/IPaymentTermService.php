<?php

namespace App\Classes\Services\Interfaces;


interface IPaymentTermService
{

    /**
     * Get all payment terms
     */
    public function getAll();
    /**
     * get list payment term supplier
     * status == on
     * type == supplier
     */
    public function getPaymentTermSupplier();

    /**
     * get list payment term customer
     * status == on
     * type == customer
     */
    public function getPaymentTermCustomer();


    /**
     * create payment term
     * @param array $data
     * @return mixed
     */
    public function createPaymentTerm($data);

    /**
     * find payment term by id
     * @param int $id
     */
    public function findById($id);

    /**
     * update payment term by id
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updatePaymentTerm($data,$id);


    /**
     * delete payment term by id
     * @param int $id
     * @return bool
     */
    public function delete($id);
}
