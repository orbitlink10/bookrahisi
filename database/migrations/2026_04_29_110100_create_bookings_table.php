<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('service_slug', 120);
            $table->string('service_name', 120);
            $table->date('appointment_date');
            $table->string('appointment_time', 20);
            $table->string('staff_slug', 120);
            $table->string('staff_name', 120);
            $table->string('customer_name', 100);
            $table->string('customer_phone', 30);
            $table->text('customer_notes')->nullable();
            $table->string('status', 30)->default('pending');
            $table->timestamps();

            $table->index(['business_id', 'appointment_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
