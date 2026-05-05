<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_email',
        'owner_first_name',
        'owner_last_name',
        'business_name',
        'slug',
        'phone',
        'business_category',
        'tagline',
        'address_line',
        'city',
        'neighborhood',
        'opening_time',
        'closing_time',
        'about',
        'youtube_url',
        'gallery_images',
        'approval_status',
        'approved_at',
        'approval_notes',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'approved_at' => 'datetime',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
