<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'customer_id',
        'membership_number',
        'membership_type',
        'points_earned',
        'points_redeemed',
        'reward_balance',
        'membership_expiry_date',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'membership_expiry_date' => 'date',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
