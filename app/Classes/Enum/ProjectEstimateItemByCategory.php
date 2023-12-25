<?php

namespace App\Classes\Enum;

use App\Models\EstProduct;
use App\Models\ProjectProduct;
use App\Traits\EnumToLabel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

enum ProjectEstimateItemByCategory: string
{
    use EnumToLabel;

    /* All names category*/
    case QB = 'QB';
    case QBStorage = 'QB倉庫保管';
    case PCS = 'PCS';
    case PANEL = 'パネル';
    case WeedControlSheet = '防草シート';
    case StorageBattery = '蓄電池';
    case OTHERS = 'その他';

    /* All fields in the table product est */
    const NameFiled = [
        'text' => '品名・型式',
        'name' => 'name'
    ];

    const NameFiledV2 = [
        'text' => '商品名',
        'name' => 'name'
    ];
    const ModelNumberFiled = [
        'text' => '型番',
        'name' => 'model_number'
    ];
    const SupplierFiled = [
        'text' => '仕入れ先',
        'name' => 'supplier'
    ];
    const PriceFiled = [
        'text' => '単価',
        'name' => 'price'
    ];
    const QuantityFiled = [
        'text' => '数量',
        'name' => 'quantity'
    ];
    const KwPriceFiled = [
        'text' => 'kw単価',
        'name' => 'kw_price',
    ];
    const WPriceFiled = [
        'text' => 'W単価',
        'name' => 'w_price',
    ];
    const M2PriceFiled = [
        'text' => '㎡単価',
        'name' => 'm2_price',
    ];
    const M2Filed = [
        'text' => '㎡',
        'name' => 'm2',
    ];
    const CapacityFiled = [
        'text' => '容量',
        'name' => 'capacity',
    ];
    const PurchasePriceFiled = [
        'text' => '仕入れ単価',
        'name' => 'purchase_price',
    ];
    const UnitFiled = [
        'text' => '単位',
        'name' => 'unit'
    ];
    const TotalFiled = [
        'text' => '合計',
        'name' => 'total'
    ];
    const TERASPurchasingFiled = [
        'text' => 'TERAS仕入',
        'name' => 'TERAS_purchasing'
    ];
    const EnbluePurchaseFiled = [
        'text' => 'エンブルー仕入',
        'name' => 'Enblue_purchase'
    ];


    public function filedTables(): array
    {
        /* Each category corresponds to the fields in the product estimate items table "見積り項目作成"
         + view: register/update project
        */
        return match ($this) {
            ProjectEstimateItemByCategory::QB => [
                ProjectEstimateItemByCategory::NameFiled,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::SupplierFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::UnitFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ],

            ProjectEstimateItemByCategory::QBStorage => [
                ProjectEstimateItemByCategory::NameFiled,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                ProjectEstimateItemByCategory::UnitFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ],

            ProjectEstimateItemByCategory::PCS => [
                ProjectEstimateItemByCategory::NameFiled,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::KwPriceFiled,
                ProjectEstimateItemByCategory::CapacityFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled

            ],

            ProjectEstimateItemByCategory::PANEL => [
                ProjectEstimateItemByCategory::NameFiledV2,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::SupplierFiled,
                ProjectEstimateItemByCategory::WPriceFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ],

            ProjectEstimateItemByCategory::WeedControlSheet => [
                ProjectEstimateItemByCategory::NameFiledV2,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::SupplierFiled,
                ProjectEstimateItemByCategory::M2PriceFiled,
                ProjectEstimateItemByCategory::M2Filed,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ],

            ProjectEstimateItemByCategory::StorageBattery => [
                ProjectEstimateItemByCategory::NameFiledV2,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::SupplierFiled,
                ProjectEstimateItemByCategory::KwPriceFiled,
                ProjectEstimateItemByCategory::CapacityFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                /* Total = price * quantity  */
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ],

            ProjectEstimateItemByCategory::OTHERS => [
                ProjectEstimateItemByCategory::NameFiledV2,
                ProjectEstimateItemByCategory::ModelNumberFiled,
                ProjectEstimateItemByCategory::SupplierFiled,
                ProjectEstimateItemByCategory::PurchasePriceFiled,
                ProjectEstimateItemByCategory::PriceFiled,
                ProjectEstimateItemByCategory::QuantityFiled,
                ProjectEstimateItemByCategory::TotalFiled,
                ProjectEstimateItemByCategory::TERASPurchasingFiled,
                ProjectEstimateItemByCategory::EnbluePurchaseFiled
            ]
        };
    }

    /* Get the value for each field in project products handmade  */
    public function getValueInFiledByProjectProductsHandMade(ProjectProduct $product, $filed)
    {
        try {
            $return = match ($filed) {
                ProjectEstimateItemByCategory::NameFiled['name'] => $product->name,
                ProjectEstimateItemByCategory::ModelNumberFiled['name'] => $product->model_number,
                ProjectEstimateItemByCategory::SupplierFiled['name'] => ($product->supplier) ? $product->supplier->name : '',
                ProjectEstimateItemByCategory::PriceFiled['name'] => $product->price,
                ProjectEstimateItemByCategory::PurchasePriceFiled['name'] => $product->purchase_price,
                ProjectEstimateItemByCategory::QuantityFiled['name'] => $product->quantity,
                ProjectEstimateItemByCategory::TotalFiled['name'] => ($product->price && $product->quantity) ? number_format($product->price * $product->quantity) : '',
                ProjectEstimateItemByCategory::UnitFiled['name'] => $product->unit,
                default => '',
            };
        } catch (\Exception $e) {
            Log::error('Error show value filed product est in project: ' . $e->getMessage());
            $return = 'NAN';
        }
        return $return;
    }

    /* Get the value for each field in project products system  */
    public function getValueInFiledByProjectProductsSystem(ProjectProduct $projectProduct, $filed)
    {
        $product = $projectProduct->estProduct;
        try {
            $return = match ($filed) {
                ProjectEstimateItemByCategory::NameFiled['name'] => $product->name,
                ProjectEstimateItemByCategory::ModelNumberFiled['name'] => $product->model_number,
                ProjectEstimateItemByCategory::SupplierFiled['name'] => optional($product->supplierAmounts->first())->supplier->name ?? '',
                ProjectEstimateItemByCategory::PriceFiled['name'] => $this->calculateTotalPriceSystem($projectProduct, true)['price'],
                ProjectEstimateItemByCategory::QuantityFiled['name'] => $this->calculateTotalPriceSystem($projectProduct, true)['quantity'],
                ProjectEstimateItemByCategory::TotalFiled['name'] => $this->calculateTotalPriceSystem($projectProduct, true)['total'],
                ProjectEstimateItemByCategory::UnitFiled['name'] => $product->unit,
                default => '',
            };
        } catch (\Exception $e) {
            Log::error('Error show value filed product est in project: ' . $e->getMessage());
            $return = 'NAN';
        }
        return $return;
    }

    public function calculateTotalPriceSystem($projectProduct, $format = false): array
    {
        $price =  '';
        $quantity = '';
        $total = '';
        if ($projectProduct->estSupplierAmount) {
            $price = $projectProduct->estSupplierAmount->price;
            if ($projectProduct->estSupplierAmount->productQuantity) {
                $quantity = $projectProduct->estSupplierAmount->productQuantity->quantity;
            }
        }
        if ($price !== '' && $quantity !== '') {
            $total = $price * $quantity;
        }
        return [
            'price' => ($price !== '' && $format) ? number_format($price) : $price,
            'quantity' => ($quantity !== '' && $format) ? number_format($quantity) : $quantity,
            'total' => ($total !== '' && $format) ? number_format($total) : $total,
        ];
    }
}
