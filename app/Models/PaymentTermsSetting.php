<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTermsSetting extends Model
{
    use HasFactory;
    protected $table = 'payment_terms_setting';

    protected $guarded = [];
}
