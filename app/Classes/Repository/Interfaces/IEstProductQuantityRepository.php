<?php

namespace App\Classes\Repository\Interfaces;

interface IEstProductQuantityRepository extends IBaseRepository
{
    /**
     * Delete all product quantities associated with a specific product by its ID.
     *
     * @param  int  $id The ID of the product for which to delete all quantities.
     * @return void
     */
    public function deleteAllProductQuantityByProductId($id);

    /**
     * Get the quantity IDs associated with a specific product by its ID.
     *
     * @param  int  $id The ID of the product to retrieve quantity IDs for.
     * @return array An array of quantity IDs associated with the product.
     */
    public function getQuantityIdByProductId($id);
}
