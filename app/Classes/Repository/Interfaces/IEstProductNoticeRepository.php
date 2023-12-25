<?php

namespace App\Classes\Repository\Interfaces;

interface IEstProductNoticeRepository extends IBaseRepository
{
    /**
     * Delete all product notices associated with a specific product by its ID.
     *
     * @param  int  $id The ID of the product for which to delete all notices.
     * @return void
     */
    public function deleteAllProductNoticeByProductId($id);
}
