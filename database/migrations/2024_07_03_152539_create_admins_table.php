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
        //
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            
            $table->uuid('dept_id');
            $table->uuid('major_id');
            $table->string('line',20);
            $table->string('meet')->nullable();
            $table->string('spot');
            
            $table->foreign('dept_id')->references('id')->on('departments')->OnDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->OnDelete('cascade');
            
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('admins');
    }
};
