<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'supplies';

    protected $guarded = [];

     /**
     * Get the supplier_managers associated with the suppliers.
     */
    public function supplier_managers()
    {
        return $this->hasMany(SupplierManagers::class, 'supplier_id');
    }

    public function supplierAmounts()
    {
        return $this->hasMany(EstSupplierAmount::class, 'supplier_id');
    }

    /**
     * Get the first 3 digits of the postcode.
     *
     * @return string|null
     */
    public function getPostcodeFirstAttribute()
    {
        return substr($this->postcode, 0, 3);
    }

    public function getPostcodeLastAttribute()
    {
        return substr($this->postcode, 3, 4);
    }


}
