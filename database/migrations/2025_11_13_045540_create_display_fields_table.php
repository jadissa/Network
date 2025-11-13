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
        Schema::create('preferences', function (Blueprint $table) {
            // Laravel convention is to use an auto-incrementing ID as primary key.
            // Since your SQL didn't specify one, I'll add one here:
            $table->id(); 
            
            // Your 'field_name' varchar not null
            $table->string('field_name')->unique(); // Added unique constraint as this is likely a distinct field identifier

            // Your 'shown' integer not null default '1'
            $table->boolean('shown')->default(1); // Using boolean is idiomatic for integer flags in Laravel

            // 'created_at' and 'updated_at' datetime columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferences');
    }
};