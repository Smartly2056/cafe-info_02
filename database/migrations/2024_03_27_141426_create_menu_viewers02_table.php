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
        Schema::create('menu_viewers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->date('show_date')->nullable(true);
            $table->boolean('sold_out')->default(false);
            $table->timestamps();
            $table
                ->foreign('menu_id')
                ->references('id')
                ->on('menu_lists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_viewers');
    }
};
