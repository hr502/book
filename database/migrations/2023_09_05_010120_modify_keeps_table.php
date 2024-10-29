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
            $table->dateTime('start_at')->change();
            $table->dateTime('end_at')->change();
            $table->dateTime('canceled_at')->nullable()->change();
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
