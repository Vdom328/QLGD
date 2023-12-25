<?php

namespace App\Classes\Services;

use App\Classes\Repository\Interfaces\IProjectProductRepository;
use App\Classes\Services\Interfaces\IProjectProductService;
use App\Models\Project;

class ProjectProductService implements IProjectProductService
{
    protected $projectProductRepository;

    public function __construct(
        IProjectProductRepository $projectProductRepository
    )
    {
        $this->projectProductRepository = $projectProductRepository;
    }

    /**
     * @inheritDoc
     */
    public function calculateTotalEst(Project $project): array
    {
        $totalPurchase = 0;
        $totalEstimated = 0;

        $projectProducts = $project->projectProducts;
        if ($projectProducts->count() > 0) {
            /* Calculate total purchase amount "仕入れ小計" total purchase = quantity * purchase price (only in product handmade) */
            $projectProductsHandMade = $projectProducts->whereNull('est_product_id');
            if ($projectProductsHandMade->count() > 0) {
                foreach ($projectProductsHandMade as $projectProduct) {
                    if ($projectProduct->purchase_price && $projectProduct->quantity) {
                        $totalPurchase += ($projectProduct->purchase_price * $projectProduct->quantity);
                    }
                }
            }

            /* Calculate total estimated amount "見積り小計" total purchase = quantity * price */
            $projectProductsSystem = $projectProducts;
            if ($projectProductsSystem->count() > 0) {
                foreach ($projectProductsSystem as $projectProduct) {
                    /* handmade */
                    if ($projectProduct->price && $projectProduct->quantity) {
                        $totalEstimated += ($projectProduct->price * $projectProduct->quantity);
                    }

                    /* system */
                    if ($projectProduct->supplier_amount_id) {
                        $estSupplierAmount = $projectProduct->estSupplierAmount;
                        if ($estSupplierAmount && $estSupplierAmount->productQuantity) {
                            $totalEstimated += ($estSupplierAmount->price * $estSupplierAmount->productQuantity->quantity);
                        }
                    }
                }
            }
        }

        return [
            'totalPurchase' => $totalPurchase,
            'totalEstimated' => $totalEstimated,
        ];
    }
}
