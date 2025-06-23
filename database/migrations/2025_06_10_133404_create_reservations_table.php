<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('car_uuid');
            $table->uuid('customer_uuid');
            $table->dateTime('rent_start_date')->nullable();
            $table->dateTime('rent_end_date')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed', 'rejected'])->default('pending');
            $table->enum('reservation_type', ['rent', 'sale'])->default('rent');
            $table->decimal('total_rent_price', 10, 2)->default(0.00)->nullable();
            $table->decimal('total_sale_price', 10, 2)->default(0.00)->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->softDeletes();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->foreign('car_uuid')->references('uuid')->on('cars')->onDelete('cascade');
            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
            $table->index(['uuid', 'car_uuid', 'customer_uuid']);
            $table->index(['rent_start_date', 'rent_end_date']);
            $table->index(['status', 'reservation_type']);
            $table->index(['is_confirmed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
