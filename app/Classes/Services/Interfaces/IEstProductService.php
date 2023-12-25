<?php

namespace App\Classes\Services\Interfaces;

interface IEstProductService
{
    /**
     * Automatically generate a product code.
     *
     * @return string
     */
    public function autoGenCode();

    /**
     * Save a newly created product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCreateProduct($request);

    /**
     * List products based on the provided data.
     *
     * @param  array  $data
     * @return \Illuminate\Http\Response
     */
    public function listProduct($data);

    /**
     * Get product details by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProductById($id);

    /**
     * Save or update a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveUpdateProduct($request, $id);

    /**
     * Delete a product by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id);
}
