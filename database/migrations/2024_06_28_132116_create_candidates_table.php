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
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name',100);
            $table->string('email',100)->unique();
            $table->uuid('major_id');
            $table->decimal('gpa',3,2)->comment('IPK');
            $table->boolean('gender')->comment('0: male, 1: female');
            $table->string('religion',50);
            $table->string('birth_place',50)->comment('kota lahir');
            $table->date('birth_date');

            $table->string('address',100);
            $table->string('line',50);
            $table->string('instagram',50);
            $table->string('tiktok',50)->nullable();

            $table->text('motivation');
            $table->text('commitment');
            $table->text('strength');
            $table->text('weakness');
            $table->text('experience')->nullable();
            $table->json('documents')->nullable();

            $table->uuid('accepted_department')->nullable();
            $table->uuid('priority_department1');
            $table->uuid('priority_department2')->nullable();
            $table->unsignedTinyInteger('phase')->default(1)->comment('1:data phase,2:file phase,3:select time,4:waiting interview, 5:after interview');

            $table->foreign('major_id')->references('id')->on('majors')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('candidates');
    }
};
