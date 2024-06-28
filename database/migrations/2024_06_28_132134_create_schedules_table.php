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
        Schema::create('schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('interviewer_id');
            $table->uuid('date_id');
            $table->uuid('candidate_id')->nullable();
            $table->integer('online')->default(0)->comment('0: onsite, 1: online');

            $table->integer('time');
            $table->integer('status')->default(0)->comment('0: not available, 1: available, 2: booked');
            $table->unique(array('interviewer_id', 'date_id', 'time'));

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('interviewer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('date_id')->references('id')->on('dates')->onDelete('cascade');
            $table->foreign('candidate_id')->references('id')->on('candidates')->onDelete('set null');    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('schedules');
    }
};
