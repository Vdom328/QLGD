<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IEstProductRepository;
use App\Models\EstProduct;

class EstProductRepository extends BaseRepository implements IEstProductRepository
{
    public function __construct(EstProduct $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function exists($code)
    {
        $bool = $this->model->where('control_number', $code)->exists();

        return $bool;
    }

    /**
     * @inheritdoc
     */
    public function listProduct($data)
    {
        $column = $data['column'] ?? null;
        $direction = $data['direction'] ?? null;
        $key = $data['key'] ?? '';
        $category_id = $data['category_id'] ?? '';
        $filter_me = $data['filter_me'] ?? 'false';
        $supplier_id = $data['supplier_id'] ?? '';

        $products = $this->model;

        if ($key != '') {
            $products = $products->where('name', 'LIKE', '%' . $key . '%');
        }

        if ($category_id != '') {
            $products = $products->where('category_id', $category_id);
        }

        $products = $products->with(['supplierAmounts' => function ($query) use ($filter_me, $supplier_id) {
            if ($filter_me == 'true') {
                $query->where('status', 1)->orderBy('price');
            } else {
                if ($supplier_id !== '') {
                    $query->where('supplier_id', (int)$supplier_id);
                }
                $query->orderBy('price');
            }
        }])->get();


        $products = $products
            ->filter(function ($product) {
                return $product->supplierAmounts->isNotEmpty();
            })
            ->sortBy(function ($product) {
                return optional($product->supplierAmounts->first())->supplier->name;
            }, SORT_REGULAR, $direction === 'desc');


        $perPage = 20;
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
        $currentPageItems = $products->slice(($page - 1) * $perPage, $perPage)->values();

        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            count($products),
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        $attr = [
            'column' => $column,
            'direction' => $direction,
            'key' => $key,
            'category_id' => $category_id,
            'products' => $products,
            'filter_me' => $filter_me,
        ];

        return $attr;
    }
}
