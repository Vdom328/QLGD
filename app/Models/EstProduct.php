<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstProduct extends Model
{
    use HasFactory;

    protected $table = 'est_products';

    protected $guarded = [];

    public function productKeyWords()
    {
        return $this->hasMany(EstProductKeyWord::class, 'est_product_id');
    }

    public function productNotices()
    {
        return $this->hasMany(EstProductNotice::class, 'est_product_id');
    }

    public function productQuantities()
    {
        return $this->hasMany(EstProductQuantity::class, 'est_product_id');
    }

    public function supplierAmounts()
    {
        return $this->hasMany(EstSupplierAmount::class, 'est_product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
