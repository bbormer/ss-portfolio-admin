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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('seq-no');
            $table->string('image');
            $table->string('title-ja');
            $table->string('title-en');
            $table->string('desc-ja', 2048)->nullable();
            $table->string('desc-en', 2048)->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('amount');
            $table->unsignedInteger('shipping');
            $table->tinyInteger('availability'); // -1: not for sale | 0: sold | 1:for sale
            $table->string('details-ja');
            $table->string('details-en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
