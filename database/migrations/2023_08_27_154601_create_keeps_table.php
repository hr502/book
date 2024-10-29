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
        Schema::create('keeps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('item_jan');
            $table->date('date_from');
            $table->date('date_to');
            $table->tinyInteger('status')->default(1);
            $table->dateTime('canceled_at')->default(null);
            $table->timestamps();

            $table->foreign('item_jan')
                ->references('jan')
                ->on('item_jans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keeps');
    }
};
