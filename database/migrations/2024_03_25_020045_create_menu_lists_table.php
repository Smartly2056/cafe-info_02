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
        Schema::create('menu_lists', function (Blueprint $table) {
            $table->id();
            $table->string('menu');
            $table->integer('price');
            $table->text('picture');
            $table->float('energy');
            $table->float('protein');
            $table->float('lipid');
            $table->float('carbohydrates');
            $table->float('salt');
            $table->float('calcium');
            $table->float('vegetable');
            $table->boolean('halal')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_lists');
    }
};
