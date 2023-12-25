<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierManagers extends Model
{
    use HasFactory;

    protected $table = 'supplier_managers';

    protected $guarded = [];

    /**
     * Get the supplier_managers associated with the suppliers.
     */
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }


    public function staff()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'person_in_charge_id');
    }
}
