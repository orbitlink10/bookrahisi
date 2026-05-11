<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'branch_id',
        'appointment_id',
        'customer_id',
        'staff_id',
        'receipt_number',
        'transaction_date',
        'subtotal',
        'discount_amount',
        'vat_amount',
        'total_amount',
        'payment_method',
        'amount_paid',
        'balance_amount',
        'sales_channel',
        'loyalty_points_earned',
        'loyalty_points_redeemed',
        'currency',
        'notes',
        'closed_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
        'transaction_date' => 'datetime',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }
}
