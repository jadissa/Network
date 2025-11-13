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
        Schema::create('requests', function (Blueprint $table) {
            // Your primary key is 'ip_address'
            $table->string('ip_address')->primary();

            // The rest of the string/varchar fields
            $table->string('server_hostname')->nullable();
            $table->string('origin')->nullable();
            $table->string('location')->nullable();

            // Text fields
            $table->text('whois')->nullable();
            $table->text('process')->nullable();
            $table->text('comments')->nullable();

            // The 'reviewed' integer with a default value
            $table->boolean('reviewed')->default(0); // Using boolean is idiomatic for integer flags in Laravel

            // 'created_at' and 'updated_at' datetime columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('requests');
    }
};