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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->softDeletes(); // For soft deletes
            $table->string('created_by')->nullable(); // Optional, if you want to track who created the record
            $table->string('updated_by')->nullable(); // Optional, if you want to track who updated the record
            $table->string('deleted_by')->nullable(); // Optional, if you want to track who deleted the record
            /* Foreign key will be added in a separate migration after both tables exist */
            $table->index(['uuid', 'user_id']); // Index for faster lookups
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
