<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IEstProductKeyWordRepository;
use App\Classes\Repository\Interfaces\IEstProductNoticeRepository;
use App\Classes\Repository\Interfaces\IEstProductQuantityRepository;
use App\Classes\Repository\Interfaces\IEstProductRepository;
use App\Classes\Repository\Interfaces\IEstSupplierAmountRepository;
use App\Classes\Repository\Interfaces\IProjectProductRepository;
use App\Classes\Services\Interfaces\IEstProductService;


/**
 * Implement UserService
 */
class EstProductService extends BaseService implements IEstProductService
{
    private $projectProductRepository, $estProductRepository, $estProductKeyWordRepository, $estProductNoticeRepository, $estProductQuantityRepository, $estSupplierAmountRepository;

    public function __construct(
        IEstProductRepository $estProductRepository,
        IEstProductNoticeRepository $estProductNoticeRepository,
        IEstProductKeyWordRepository $estProductKeyWordRepository,
        IEstProductQuantityRepository $estProductQuantityRepository,
        IProjectProductRepository $projectProductRepository,
        IEstSupplierAmountRepository $estSupplierAmountRepository
    ) {
        $this->estProductRepository = $estProductRepository;
        $this->estProductKeyWordRepository = $estProductKeyWordRepository;
        $this->estProductNoticeRepository = $estProductNoticeRepository;
        $this->estProductQuantityRepository = $estProductQuantityRepository;
        $this->estSupplierAmountRepository = $estSupplierAmountRepository;
        $this->projectProductRepository = $projectProductRepository;
    }

    /**
     * @inheritdoc
     */
    public function listProduct($data)
    {
        return $this->estProductRepository->listProduct($data);
    }

    /**
     * @inheritdoc
     */
    public function autoGenCode()
    {
        // If the number is not unique, generate a new one
        for ($code = 1; $code <= 99999; $code++) {
            $exists = $this->estProductRepository->exists($code);
            if (!$exists) {
                return str_pad($code, 5, '0', STR_PAD_LEFT);
            }
        }
        return $code;
    }

    /**
     * @inheritdoc
     */
    public function saveCreateProduct($request)
    {
        $product = [
            'control_number' => $request['control_number'],
            'category_id' => $request['category_id'],
            'model_number' => $request['model_number'],
            'name' => $request['name'],
            'memo' => $request['memo_product'],
        ];

        $product = $this->estProductRepository->create($product);

        if ($request['keywords']) {
            $keywords = json_decode($request['keywords']);
            $this->saveProductKeyWords($product->id, $keywords);
        }

        if ($request['notices']) {
            $notices = json_decode($request['notices']);
            $this->saveProductNotices($product->id, $notices);
        }

        if ($request['quantities']) {
            $quantities = json_decode($request['quantities']);
            $this->saveProductQuantities($product->id, $quantities);
        }
    }

    /**
     * @inheritdoc
     */
    public function getProductById($id)
    {
        return $this->estProductRepository->findById($id);
    }

    /**
     * @inheritdoc
     */
    public function saveUpdateProduct($request, $id)
    {
        $product = [
            'control_number' => $request['control_number'],
            'category_id' => $request['category_id'],
            'model_number' => $request['model_number'],
            'name' => $request['name'],
            'memo' => $request['memo_product'],
        ];

        $this->estProductRepository->updateById($id, $product);

        $this->estProductKeyWordRepository->deleteAllProductKeyWordByProductId($id);
        if ($request['keywords']) {
            $keywords = json_decode($request['keywords']);
            $this->saveProductKeyWords($id, $keywords);
        }

        $this->estProductNoticeRepository->deleteAllProductNoticeByProductId($id);
        if ($request['notices']) {
            $notices = json_decode($request['notices']);
            $this->saveProductNotices($id, $notices);
        }

        $quantityId = $this->estProductQuantityRepository->getQuantityIdByProductId($id);

        $this->estSupplierAmountRepository->deleteAllSupplierAmountByProductQuantityId($quantityId);

        $this->estProductQuantityRepository->deleteAllProductQuantityByProductId($id);

        if ($request['quantities']) {
            $quantities = json_decode($request['quantities']);
            $this->saveProductQuantities($id, $quantities);
        }
    }

    /**
     * Save product keywords associated with a product.
     *
     * @param  int  $productId
     * @param  array  $keywords
     * @return void
     */
    private function saveProductKeyWords($productId, $keywords)
    {
        foreach ($keywords as $key => $value) {
            $attr = [];
            foreach ($value as $item) {
                $name = $item->name;
                $val = $item->value;

                if (str_contains($name, 'bank_id')) {
                    $attr['id'] = $val;
                    continue;
                }

                $attr[$name] = $val;

                if (empty($attr['id']) || $attr['id'] <= 0) {
                    $attr['est_product_id'] = $productId;
                    $this->estProductKeyWordRepository->create($attr);
                } else {
                    $productKeyWord = $this->estProductKeyWordRepository->findById($attr['id']);
                    if ($productKeyWord) {
                        $productKeyWord->update($attr);
                    }
                }
            }
        }
    }

    /**
     * Save product notices associated with a product.
     *
     * @param  int  $productId
     * @param  array  $notices
     * @return void
     */
    private function saveProductNotices($productId, $notices)
    {
        foreach ($notices as $key => $value) {
            $attr = [];

            foreach ($value as $item) {
                $name = $item->name;
                $val = $item->value;

                if (str_contains($name, 'bank_id')) {
                    $attr['id'] = $val;
                    continue;
                }

                $attr[$name] = $val;

                if (empty($attr['id']) || $attr['id'] <= 0) {
                    $attr['est_product_id'] = $productId;
                    $this->estProductNoticeRepository->create($attr);
                } else {
                    $productNotice = $this->estProductNoticeRepository->findById($attr['id']);
                    if ($productNotice) {
                        $productNotice->update($attr);
                    }
                }
            }
        }
    }

    /**
     * Save product quantities associated with a product.
     *
     * @param  int  $productId
     * @param  array  $quantities
     * @return void
     */
    private function saveProductQuantities($productId, $quantities)
    {
        foreach ($quantities as $quantityData) {
            $productQuantity = $this->estProductQuantityRepository->create([
                'est_product_id' => $productId,
                'quantity' => $quantityData->quantity,
            ]);

            $this->saveSupplierAmount($productId, $productQuantity->id, $quantityData->amounts);
        }
    }

    /**
     * Save supplier amounts associated with a product quantity.
     *
     * @param  int  $productId
     * @param  int  $productQuantityId
     * @param  array  $amounts
     * @return void
     */
    private function saveSupplierAmount($productId, $productQuantityId, $amounts)
    {
        foreach ($amounts as $amountData) {
            $status = isset($amountData->status) ? $amountData->status : 0;
            $this->estSupplierAmountRepository->create(
                [
                    'est_product_id' => $productId,
                    'est_product_quantity_id' => $productQuantityId,
                    'status' => $status,
                    'supplier_id' => $amountData->supplier_id,
                    'price' => $amountData->price,
                    'selling_price' => $amountData->selling_price,
                    'min_quantity' => $amountData->min_quantity,
                    'memo' => $amountData->memo,
                ]
            );
        }
    }

    /**
     * @inheritdoc
     */
    public function delete($id)
    {
        $existingProjects = $this->projectProductRepository->getByProductId($id);

        if (!$existingProjects) {
            $this->estProductRepository->deleteById($id);

            $this->estProductQuantityRepository->deleteAllProductQuantityByProductId($id);

            $this->estProductNoticeRepository->deleteAllProductNoticeByProductId($id);

            $this->estProductKeyWordRepository->deleteAllProductKeyWordByProductId($id);

            return  true;
        } else {
            return false;
        }
    }
}
