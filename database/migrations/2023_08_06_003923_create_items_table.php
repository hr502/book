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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->string('series')->nullable();
            $table->text('detail');
            $table->string('published_on');
            $table->string('classification');
            $table->string('code');
            $table->integer('price');
            $table->string('type_code');
            $table->string('file_name');
            $table->string('file_path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('type_code')
                ->references('code')
                ->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
