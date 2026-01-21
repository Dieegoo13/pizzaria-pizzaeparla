<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_size_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pizza_id')->constrained()->cascadeOnDelete();
            $table->foreignId('pizza_size_id')->constrained()->cascadeOnDelete();

            $table->decimal('price', 8, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_size_prices');
    }
};
