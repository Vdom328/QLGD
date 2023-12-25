<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstProductKeyWord extends Model
{
    use HasFactory;

    protected $table = 'est_product_keywords';

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(EstProduct::class, 'est_product_id');
    }
}
