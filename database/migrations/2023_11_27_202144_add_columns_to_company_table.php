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
        Schema::table('company', function (Blueprint $table) {
            $table->string('poc');
            $table->string('number_of_employees');
            $table->string('address');
            $table->string('ntn')->nullable();
            $table->string('short_desc');
            $table->string('linkedin_address');
            $table->string('website_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('poc');
            $table->string('number_of_employees');
            $table->string('address');
            $table->string('ntn')->nullable();
            $table->string('short_desc');
            $table->string('linkedin_address');
            $table->string('website_address');
        });
    }
};
