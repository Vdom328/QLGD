<?php

namespace App\Classes\Enum;

/*
 * 状況
1: 見積もり待ち - WaitForEstimate
2: 見積もり済み - EstimateCompleted
3: 受注 - OrderReceived
4: 失注（手動）- LostOrders
5: 発注済み - Ordered
6: 納品済み - CompleteDelivery
7: 請求済み - Invoiced
8: 支払い済み - Paid
 */

use App\Traits\EnumToLabel;

enum ProjectStatusEnum: int
{
    use EnumToLabel;

    case EstimateCompleted = 1;
    case OrderReceived = 2;
    case LostOrders = 3;
    case WaitingForOrder = 4;
    case WaitingForDelivery = 5;
    case CompleteDelivery = 6;
    case WaitingForBilling = 7;
    case Invoiced = 8;
    case Deposited = 9;

    public function label(): string
    {
        return match ($this) {
            ProjectStatusEnum::EstimateCompleted => '見積もり済み ',
            ProjectStatusEnum::OrderReceived => '受注 ',
            ProjectStatusEnum::LostOrders => '失注',
            ProjectStatusEnum::WaitingForOrder => '発注待ち ',
            ProjectStatusEnum::WaitingForDelivery => '納品待ち ',
            ProjectStatusEnum::CompleteDelivery => '納品済み ',
            ProjectStatusEnum::WaitingForBilling => '請求待ち',
            ProjectStatusEnum::Invoiced => '請求済み ',
            ProjectStatusEnum::Deposited => '入金済み'
        };
    }

}

