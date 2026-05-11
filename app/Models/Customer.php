<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'branch_id',
        'user_id',
        'customer_code',
        'full_name',
        'phone_number',
        'email',
        'gender',
        'date_of_birth',
        'customer_type',
        'preferred_staff_id',
        'visit_notes',
        'allergies',
        'skin_type',
        'hair_type',
        'preferred_massage_pressure',
        'loyalty_points',
        'last_visit_date',
        'referral_source',
        'sms_reminder_ready',
        'whatsapp_reminder_ready',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'last_visit_date' => 'date',
        'sms_reminder_ready' => 'boolean',
        'whatsapp_reminder_ready' => 'boolean',
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function preferredStaff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'preferred_staff_id');
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function loyaltyTransactions(): HasMany
    {
        return $this->hasMany(LoyaltyPoint::class);
    }

    public function membership(): HasOne
    {
        return $this->hasOne(Membership::class);
    }
}
