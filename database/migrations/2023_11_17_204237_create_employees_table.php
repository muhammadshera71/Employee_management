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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->String("name");
            $table->unsignedBigInteger('users_id');
            // $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            // $table->String("name");
            $table->enum('status', ['active', 'inactive', 'on_leave', 'terminated']);
            $table->String("Designation");
            $table->bigInteger("cnic");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
