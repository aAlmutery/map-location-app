<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('coolers', function (Blueprint $table) {
            // Make outlet_type nullable since it's not included in the CSV import
            DB::statement('ALTER TABLE coolers MODIFY outlet_type VARCHAR(255) NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coolers', function (Blueprint $table) {
            DB::statement('ALTER TABLE coolers MODIFY outlet_type VARCHAR(255) NOT NULL');
        });
    }
};
