<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('business_role', 40)->nullable()->after('account_status');
        });

        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->string('branch_code', 40)->unique();
            $table->string('name', 120);
            $table->string('phone', 30)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('address_line', 160)->nullable();
            $table->string('city', 80)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'is_primary']);
        });

        Schema::create('rooms_chairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('resource_code', 40)->unique();
            $table->string('name', 120);
            $table->string('resource_type', 20)->default('chair');
            $table->string('status', 20)->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'resource_type']);
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('staff_code', 40)->unique();
            $table->string('full_name', 120);
            $table->string('role', 40);
            $table->string('phone_number', 30);
            $table->string('email', 255)->nullable();
            $table->string('commission_type', 20)->nullable();
            $table->decimal('commission_rate', 8, 2)->nullable();
            $table->json('shift_schedule')->nullable();
            $table->boolean('can_receive_product_commission')->default(false);
            $table->string('status', 20)->default('active');
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'role']);
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('customer_code', 40)->unique();
            $table->string('full_name', 120);
            $table->string('phone_number', 30);
            $table->string('email', 255)->nullable();
            $table->string('gender', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('customer_type', 20)->default('Regular');
            $table->foreignId('preferred_staff_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->text('visit_notes')->nullable();
            $table->text('allergies')->nullable();
            $table->string('skin_type', 60)->nullable();
            $table->string('hair_type', 60)->nullable();
            $table->string('preferred_massage_pressure', 60)->nullable();
            $table->integer('loyalty_points')->default(0);
            $table->date('last_visit_date')->nullable();
            $table->string('referral_source', 120)->nullable();
            $table->boolean('sms_reminder_ready')->default(true);
            $table->boolean('whatsapp_reminder_ready')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'customer_type']);
            $table->index(['business_id', 'phone_number']);
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('service_code', 40)->unique();
            $table->string('name', 120);
            $table->string('category', 40);
            $table->decimal('price', 12, 2);
            $table->unsignedInteger('duration_minutes');
            $table->string('commission_type', 20)->nullable();
            $table->decimal('commission_rate', 8, 2)->nullable();
            $table->boolean('vat_applicable')->default(true);
            $table->decimal('vat_rate', 5, 2)->default(16);
            $table->string('gender_type', 20)->default('Unisex');
            $table->json('required_products')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'category']);
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_code', 40)->unique();
            $table->string('name', 120);
            $table->string('barcode', 80)->nullable();
            $table->string('category', 40);
            $table->string('supplier', 120)->nullable();
            $table->decimal('buying_price', 12, 2);
            $table->decimal('selling_price', 12, 2);
            $table->decimal('current_stock', 12, 2)->default(0);
            $table->decimal('reorder_level', 12, 2)->default(0);
            $table->date('expiry_date')->nullable();
            $table->decimal('vat_rate', 5, 2)->default(16);
            $table->string('shelf_location', 80)->nullable();
            $table->boolean('commission_enabled')->default(false);
            $table->string('commission_type', 20)->nullable();
            $table->decimal('commission_rate', 8, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'category']);
            $table->index(['business_id', 'current_stock', 'reorder_level']);
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->foreignId('room_chair_id')->nullable()->constrained('rooms_chairs')->nullOnDelete();
            $table->string('appointment_number', 40)->unique();
            $table->date('booking_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedInteger('duration_minutes');
            $table->string('status', 20)->default('Pending');
            $table->text('notes')->nullable();
            $table->boolean('reminder_sent')->default(false);
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'booking_date', 'status']);
            $table->index(['business_id', 'staff_id', 'booking_date']);
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->string('receipt_number', 40)->unique();
            $table->timestamp('transaction_date');
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('vat_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->string('payment_method', 30)->default('Cash');
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->decimal('balance_amount', 12, 2)->default(0);
            $table->string('sales_channel', 30)->default('Walk-in');
            $table->integer('loyalty_points_earned')->default(0);
            $table->integer('loyalty_points_redeemed')->default(0);
            $table->string('currency', 3)->default('KES');
            $table->text('notes')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'branch_id', 'transaction_date']);
        });

        Schema::create('sale_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id')->nullable()->constrained('staff')->nullOnDelete();
            $table->string('item_type', 20);
            $table->string('description', 160);
            $table->decimal('quantity', 12, 2)->default(1);
            $table->decimal('unit_price', 12, 2)->default(0);
            $table->decimal('line_subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('vat_rate', 5, 2)->default(0);
            $table->decimal('vat_amount', 12, 2)->default(0);
            $table->decimal('line_total', 12, 2)->default(0);
            $table->string('commission_type', 20)->nullable();
            $table->decimal('commission_rate', 8, 2)->nullable();
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['sale_id', 'item_type']);
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('payment_method', 30);
            $table->decimal('amount', 12, 2);
            $table->string('status', 20)->default('Paid');
            $table->string('reference', 120)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('metadata')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'payment_method', 'status']);
        });

        Schema::create('mpesa_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('payment_id')->constrained()->cascadeOnDelete();
            $table->string('mpesa_code', 60)->unique();
            $table->string('phone_number', 30);
            $table->string('till_or_paybill', 60);
            $table->string('payment_status', 20)->default('Paid');
            $table->timestamp('transaction_time');
            $table->string('linked_receipt_number', 40);
            $table->timestamps();

            $table->index(['business_id', 'payment_status', 'transaction_time']);
        });

        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('quantity_change', 12, 2);
            $table->decimal('stock_before', 12, 2);
            $table->decimal('stock_after', 12, 2);
            $table->string('reason', 30);
            $table->text('notes')->nullable();
            $table->timestamp('logged_at');
            $table->timestamps();

            $table->index(['business_id', 'product_id', 'logged_at']);
        });

        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_item_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('staff_id')->constrained('staff')->cascadeOnDelete();
            $table->string('source_type', 20);
            $table->string('commission_type', 20)->nullable();
            $table->decimal('commission_rate', 8, 2)->nullable();
            $table->decimal('eligible_amount', 12, 2)->default(0);
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->date('commission_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'staff_id', 'commission_date']);
        });

        Schema::create('loyalty_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sale_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('points_earned')->default(0);
            $table->integer('points_redeemed')->default(0);
            $table->integer('balance_after')->default(0);
            $table->string('description', 160);
            $table->timestamp('recorded_at');
            $table->timestamps();

            $table->index(['business_id', 'customer_id', 'recorded_at']);
        });

        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('membership_number', 40)->unique();
            $table->string('membership_type', 20)->default('Silver');
            $table->integer('points_earned')->default(0);
            $table->integer('points_redeemed')->default(0);
            $table->integer('reward_balance')->default(0);
            $table->date('membership_expiry_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'membership_type', 'is_active']);
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->string('expense_code', 40)->unique();
            $table->string('expense_category', 40);
            $table->decimal('amount', 12, 2);
            $table->string('vendor', 120)->nullable();
            $table->string('payment_method', 30);
            $table->date('expense_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'expense_date', 'expense_category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('memberships');
        Schema::dropIfExists('loyalty_points');
        Schema::dropIfExists('commissions');
        Schema::dropIfExists('inventory_logs');
        Schema::dropIfExists('mpesa_transactions');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('sale_items');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('products');
        Schema::dropIfExists('services');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('rooms_chairs');
        Schema::dropIfExists('branches');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('business_role');
        });
    }
};
