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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users');
            $table->string('phone');
            $table->string('poc');
            $table->string('number_of_employees');
            $table->string('address');
            $table->string('ntn')->nullable();
            $table->string('short_desc');
            $table->string('linkedin_address');
            $table->string('website_address');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
