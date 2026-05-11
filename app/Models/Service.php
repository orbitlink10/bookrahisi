<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'branch_id',
        'service_code',
        'name',
        'category',
        'price',
        'duration_minutes',
        'commission_type',
        'commission_rate',
        'vat_applicable',
        'vat_rate',
        'gender_type',
        'required_products',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'required_products' => 'array',
        'vat_applicable' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function saleItems(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}
