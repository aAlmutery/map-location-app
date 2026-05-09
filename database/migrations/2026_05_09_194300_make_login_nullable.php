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
        Schema::table('coolers', function (Blueprint $table) {
            // Make login nullable and add outlet_name if not exists
            if (Schema::hasColumn('coolers', 'login')) {
                $table->string('login')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coolers', function (Blueprint $table) {
            if (Schema::hasColumn('coolers', 'login')) {
                $table->string('login')->nullable(false)->change();
            }
        });
    }
};
