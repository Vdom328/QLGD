<?php

namespace App\Classes\Repository\Interfaces;

interface IEstProductKeyWordRepository extends IBaseRepository
{
    /**
     * Delete all product keywords associated with a specific product by its ID.
     *
     * @param  int  $id The ID of the product for which to delete all keywords.
     * @return void
     */
    public function deleteAllProductKeyWordByProductId($id);
}
