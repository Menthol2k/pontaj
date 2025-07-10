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
        Schema::create('workbooks', function (Blueprint $table) {
            $table->id();
            $table->string('salary_net');
            $table->string('salary_brut');
            $table->string('registration_number');
            $table->timestamp('start_shift');
            $table->timestamp('end_shift');
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workbooks');
    }
};
