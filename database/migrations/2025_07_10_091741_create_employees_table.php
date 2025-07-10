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
            $table->unsignedBigInteger('workbook_id')->index()->nullable();
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('phone_number')->index();
            $table->string('adresa')->index();
            $table->string('position')->index();
            $table->string('location')->index();
            $table->boolean('workbook')->default(false);
            $table->date('hired_at');
            $table->date('left_at')->nullable();
            $table->boolean('status')->default(true);
            $table->text('obs')->nullable();
            $table->timestamps();

            $table->foreign('workbook_id')->references('id')->on('workbooks');
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
