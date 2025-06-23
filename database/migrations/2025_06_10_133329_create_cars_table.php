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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('brand');
            $table->string('model');
            $table->string('image_url')->nullable();
            $table->year('year');
            $table->decimal('price', 10, 2)->nullable(); 
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->integer('mileage')->default(0);
            $table->enum('availability', ['for_rent', 'for_sale'])->default('for_rent');
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid']);
            $table->boolean('in_service')->default(true);
            $table->softDeletes(); // For soft deletes
            $table->string('created_by')->nullable(); // Optional, if you want to track who created the record
            $table->string('updated_by')->nullable(); // Optional, if you want to track who updated the record
            $table->string('deleted_by')->nullable(); // Optional, if you want to track who deleted the record
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
