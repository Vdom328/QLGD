<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $guarded = [];

    public function parentProject(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }

    public function relatedFiles(): HasMany
    {
        return $this->hasMany(ProjectRelatedFile::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function todo()
    {
        return $this->hasOne(\App\Models\Todo::class, 'id', 'project_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function customerManager(): BelongsTo
    {
        return $this->belongsTo(CustomerManagers::class, 'customer_manager_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

    public function projectProducts(): HasMany
    {
        return $this->hasMany(ProjectProduct::class, 'project_id');
    }

    public function projectProductMemos(): HasMany
    {
        return $this->hasMany(ProjectProductMemo::class, 'project_id');
    }

    public function projectProductShippingFees(): HasMany
    {
        return $this->hasMany(ProjectProductShippingFees::class, 'project_id');
    }
}
