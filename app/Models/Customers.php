<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $guarded = [];

     /**
     * Get the supplier_managers associated with the suppliers.
     */
    public function customer_managers()
    {
        return $this->hasMany(CustomerManagers::class, 'customer_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'customer_id');
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
