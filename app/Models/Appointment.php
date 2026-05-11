<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'branch_id',
        'customer_id',
        'service_id',
        'staff_id',
        'room_chair_id',
        'appointment_number',
        'booking_date',
        'start_time',
        'end_time',
        'duration_minutes',
        'status',
        'notes',
        'reminder_sent',
        'reminder_sent_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'reminder_sent' => 'boolean',
        'reminder_sent_at' => 'datetime',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function roomChair(): BelongsTo
    {
        return $this->belongsTo(RoomChair::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
