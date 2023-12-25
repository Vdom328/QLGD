<?php

namespace App\Classes\Services\Interfaces;

interface ICategoryService
{
    /**
     * Retrieves all categories from the database.
     *
     * @return array An array of all categories.
     */
    public function getAllCategory();
}
