<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstSupplierAmount extends Model
{
    use HasFactory;

    protected $table = 'est_supplier_amount';

    protected $guarded = [];

    public function productQuantity()
    {
        return $this->belongsTo(EstProductQuantity::class, 'est_product_quantity_id');
    }

    public function product()
    {
        return $this->belongsTo(EstProduct::class, 'est_product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
