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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->uuid('car_uuid')->nullable();
            $table->uuid('customer_uuid')->nullable();
            $table->dateTime('purchase_date')->nullable();
            $table->softDeletes(); 
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->foreign('car_uuid')->references('uuid')->on('cars')->onDelete('cascade');
            $table->foreign('customer_uuid')->references('uuid')->on('customers')->onDelete('cascade');
            $table->index(['uuid', 'car_uuid', 'customer_uuid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
