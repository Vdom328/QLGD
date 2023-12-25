<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProductShippingFees extends Model
{
    use HasFactory;

    protected $table = 'project_product_shipping_fees';

    protected $guarded = [];
}
