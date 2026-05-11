<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'branch_id',
        'product_code',
        'name',
        'barcode',
        'category',
        'supplier',
        'buying_price',
        'selling_price',
        'current_stock',
        'reorder_level',
        'expiry_date',
        'vat_rate',
        'shelf_location',
        'commission_enabled',
        'commission_type',
        'commission_rate',
        'is_active',
    ];

    protected $casts = [
        'commission_enabled' => 'boolean',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function inventoryLogs(): HasMany
    {
        return $this->hasMany(InventoryLog::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
