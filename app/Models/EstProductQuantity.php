<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstProductQuantity extends Model
{
    use HasFactory;

    protected $table = 'est_product_quantity';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(EstProduct::class, 'est_product_id');
    }

    public function supplierAmount()
    {
        return $this->hasMany(EstSupplierAmount::class, 'est_product_quantity_id');
    }
}
