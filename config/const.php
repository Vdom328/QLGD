<?php

use App\Classes\Enum\NotificationUserEnum;
use App\Classes\Enum\ProfileEnum;
use App\Classes\Enum\StatusPaymentTermEnum;
use App\Classes\Enum\TypePaymentTermEnum;

return [
    'profile' => [
            'no' => ProfileEnum::No,
            'yes' => ProfileEnum::Yes,
    ],
    'user_notification_setting' => [
            'no' => NotificationUserEnum::No,
            'yes' => NotificationUserEnum::Yes,
    ],
    'payment_terms' => [
        'type' => [
            'supplier' => TypePaymentTermEnum::supplier,
            'customer' => TypePaymentTermEnum::customer
        ],
        'status' => [
            'on' => StatusPaymentTermEnum::ON,
            'off' => StatusPaymentTermEnum::OFF
        ]
    ],
];
