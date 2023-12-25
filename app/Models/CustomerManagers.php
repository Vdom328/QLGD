<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerManagers extends Model
{
    use HasFactory;

    protected $table = 'customer_managers';

    protected $guarded = [];

    /**
     * Get the supplier_managers associated with the suppliers.
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }


    public function staff()
    {
        return $this->hasOne(\App\Models\User::class, 'id', 'person_in_charge_id');
    }
}
