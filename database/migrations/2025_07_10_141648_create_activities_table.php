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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id')->index();
            $table->unsignedBigInteger('created_by')->index();
            $table->unsignedBigInteger('activity_day_id')->index();
            $table->string('type');
            $table->date('date');
            $table->integer('week');
            $table->string('price');
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('activity_day_id')->references('id')->on('activity_days');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
