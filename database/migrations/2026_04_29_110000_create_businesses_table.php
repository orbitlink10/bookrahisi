<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('owner_email')->unique();
            $table->string('owner_first_name', 80);
            $table->string('owner_last_name', 80);
            $table->string('business_name', 120);
            $table->string('slug')->unique();
            $table->string('phone', 30);
            $table->string('business_category', 80);
            $table->string('tagline', 120);
            $table->string('address_line', 160);
            $table->string('city', 80);
            $table->string('neighborhood', 80);
            $table->time('opening_time');
            $table->time('closing_time');
            $table->text('about');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
