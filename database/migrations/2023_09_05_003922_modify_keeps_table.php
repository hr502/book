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
        Schema::table('keeps', function (Blueprint $table) {
            $table->renameColumn('date_from', 'start_at');
            $table->renameColumn('date_to', 'end_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keeps', function (Blueprint $table) {
            //
        });
    }
};
