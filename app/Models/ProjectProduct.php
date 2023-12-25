<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectProduct extends Model
{
    use HasFactory;

    protected $table = 'project_product';

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function estProduct(): BelongsTo
    {
        return $this->belongsTo(EstProduct::class, 'est_product_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function estSupplierAmount(): BelongsTo
    {
        return $this->belongsTo(EstSupplierAmount::class, 'supplier_amount_id');
    }
}
