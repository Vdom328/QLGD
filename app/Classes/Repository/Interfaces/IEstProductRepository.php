<?php

namespace App\Classes\Repository\Interfaces;

interface IEstProductRepository extends IBaseRepository
{
    /**
     * Check if a product with the given code exists.
     *
     * @param  string  $code The code of the product to check.
     * @return bool Returns true if the product exists, false otherwise.
     */
    public function exists($code);

    /**
     * List products based on the provided data.
     *
     * @param  array  $data The data used to filter and list products.
     * @return \Illuminate\Http\Response
     */
    public function listProduct($data);
}
