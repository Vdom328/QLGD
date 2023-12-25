<?php

namespace App\Classes\Services\Interfaces;

interface ICustomerManagerService
{
    /**
     * Get all customers manager
     */
    public function getAllCustomerManager();
    /**
     * Find customers manager by condition
     */
    public function find(array $conditions = []);
}
