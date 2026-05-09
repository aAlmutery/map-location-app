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
        Schema::create('coolers', function (Blueprint $table) {
            $table->id();
            $table->string('outlet_name')->index();
            $table->string('login')->index();
            $table->string('outlet_type');
            $table->integer('pepsi_coolers')->default(0);
            $table->integer('cola_coolers')->default(0);
            $table->integer('other_branded_coolers')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coolers');
    }
};
