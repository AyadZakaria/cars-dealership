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
            $table->decimal('total_price', 10, 2)->default(0.00);
            $table->boolean('is_confirmed')->default(false);
            $table->softDeletes(); // For soft deletes
            $table->string('created_by')->nullable(); // Optional, if you want to track who created the record
            $table->string('updated_by')->nullable(); // Optional, if you want to track who updated the record
            $table->string('deleted_by')->nullable(); // Optional, if you want to track who deleted the record
            $table->foreign('car_uuid')->references('uuid')->on('cars')->onDelete('cascade');
            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
            $table->index(['uuid', 'car_uuid', 'customer_uuid']); // Index for faster lookups
            $table->index(['rent_start_date', 'rent_end_date']); // Index for date range queries
            $table->index(['status', 'reservation_type']); // Index for status and type queries
            $table->index(['is_confirmed']); // Index for confirmation status
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
