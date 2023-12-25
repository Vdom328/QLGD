<?php

namespace App\Classes\Repository;

use App\Classes\Repository\Interfaces\IProjectProductRepository;
use App\Models\Project;
use App\Models\ProjectProduct;

class ProjectProductRepository extends BaseRepository implements IProjectProductRepository
{
    public function __construct(ProjectProduct $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritdoc
     */
    public function insertByProject($dataProducts, Project $project): void
    {
        $supplierId = !empty($dataProducts['supplier_id']) ?? null;
        $this->saveSupplierProject($project, $supplierId);
        $projectId = $project->id;
        /* Insert project product ids system */
        if (!empty($dataProducts['id_products_system']) && gettype($dataProducts['id_products_system']) == 'array') {
            $idsProductSystem = [];
            foreach ($dataProducts['id_products_system'] as $productSystem) {
                $idsProductSystem[] = [
                    'project_id' => $projectId,
                    'est_product_id' => (int)$productSystem['product_id'],
                    'supplier_amount_id' => (int)$productSystem['supplier_amount_id'],
                ];
            }
            count($idsProductSystem) > 0 ? $this->insert($idsProductSystem) : null;
        }
        /* Insert project products handmade*/
        if (!empty($dataProducts['products_handmade']) && gettype($dataProducts['products_handmade']) == 'array') {
            $productsHandmade = [];
            foreach ($dataProducts['products_handmade'] as $product) {
                $productsHandmade[] = [
                    'project_id' => $projectId,
                    'supplier_id' => $supplierId,
                    'name' => $product['name'] ?? null,
                    'model_number' => $product['model_number'] ?? null,
                    'price' => (int)$product['price'],
                    'quantity' => (int)$product['quantity'],
                    'unit' => (int)$product['unit']
                ];
            }
            count($productsHandmade) > 0 ? $this->insert($productsHandmade) : null;
        }
    }

    /**
     * @inheritdoc
     */
    public function updateByProject($dataProducts, Project $project): void
    {
        $supplierId = !empty($dataProducts['supplier_id']) ?? null;
        $this->saveSupplierProject($project, $supplierId);

        $this->updateByProjectSystem($dataProducts, $project);
        $this->updateProjectHandmade($dataProducts, $project);
    }

    /**
     * @inheritdoc
     */
    public function updateByProjectSystem($dataProducts, Project $project): void
    {
        /* Update project products ids system */
        $projectProductSystem = $project->projectProducts->whereNotNull('est_product_id');
        $idsProjectProductSystem = $projectProductSystem->pluck('id')->toArray();

        if (!empty($dataProducts['id_products_system']) && gettype($dataProducts['id_products_system']) == 'array') {
            if ($projectProductSystem->count() > 0) {
                $this->deleteByIds($idsProjectProductSystem);
            }
            $dataProductsInsert['id_products_system'] = $dataProducts['id_products_system'];
            $this->insertByProject($dataProductsInsert, $project->id);

        } else {
            /* Delete if update no data system*/
            if ($projectProductSystem->count() > 0) {
                $this->deleteByIds($idsProjectProductSystem);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function updateProjectHandmade($dataProducts, Project $project): void
    {
        $supplierId = $dataProducts['supplier_id'];
        $projectProductHandmade = $project->projectProducts->whereNull('est_product_id');
        if (!empty($dataProducts['products_handmade']) && gettype($dataProducts['products_handmade']) == 'array') {
            /* Get data containing project_product_ID */
            $dataProjectProductIds = array_filter($dataProducts['products_handmade'], function ($item) {
                return array_key_exists("project_product_id", $item);
            });
            $projectProductIds = array_map('intval', array_column($dataProjectProductIds, 'project_product_id'));

            /* Delete deleted project products */
            $idsProjectProductRemove = array_diff($projectProductHandmade->pluck('id')->toArray(), $projectProductIds);
            if (count($idsProjectProductRemove) > 0) {
                $this->deleteByIds($idsProjectProductRemove);
            }

            /* Update project products */
            $projectProductUpdateIds = array_intersect($projectProductHandmade->pluck('id')->toArray(), $projectProductIds);
            if (count($projectProductUpdateIds) > 0) {
                $dataProjectProductUpdate = array_filter($dataProducts['products_handmade'], function ($item) use ($projectProductUpdateIds) {
                    return array_key_exists("project_product_id", $item) && in_array((int)$item["project_product_id"], $projectProductUpdateIds);
                });
                foreach ($dataProjectProductUpdate as $dataUpdate) {
                    $data = [
                        'name' => $dataUpdate['name'] ?? null,
                        'model_number' => $dataUpdate['model_number'] ?? null,
                        'supplier_id' => $supplierId,
                        'kw_price' => $dataUpdate['kw_price'] ?? null,
                        'capacity' => $dataUpdate['capacity'] ?? null,
                        'purchase_price' => $dataUpdate['purchase_price'] ?? null,
                        'price' => $dataUpdate['price'] ?? null,
                        'quantity' => $dataUpdate['quantity'] ?? null,
                        'unit' => $dataUpdate['unit'] ?? null,
                    ];
                    $this->model->where('id', (int)$dataUpdate['project_product_id'])->update($data);
                }
            }

            /* Add new project product*/
            $dataProjectProductAdd = array_filter($dataProducts['products_handmade'], function ($item) {
                return !array_key_exists("project_product_id", $item);
            });
            if (count($dataProjectProductAdd) > 0) {
                $dataProductsInsert['products_handmade'] = $dataProjectProductAdd;
                $this->insertByProject($dataProductsInsert, $project->id);
            }

        } else {
            /* Delete if update no data system*/
            if ($projectProductHandmade->count() > 0) {
                $this->deleteByIds($projectProductHandmade->pluck('id')->toArray());
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function deleteByIds(array $ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->delete();
    }

    public function getByProductId($id)
    {
        return $this->model->where('est_product_id', $id)->first();
    }

    public function saveSupplierProject(Project $project, $supplierId): void
    {
        $project->supplier_id = $supplierId;
        $project->save();
    }
}
