<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'service_slug',
        'service_name',
        'appointment_date',
        'appointment_time',
        'staff_slug',
        'staff_name',
        'customer_name',
        'customer_phone',
        'customer_notes',
        'status',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'paid_at' => 'datetime',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
