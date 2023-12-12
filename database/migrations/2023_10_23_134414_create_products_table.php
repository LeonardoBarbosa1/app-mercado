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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('brand', 100)->nullable();
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->boolean('status');
            $table->bigInteger('fair_id')->unsigned();
            $table->foreign('fair_id', 'products_fair_id_foreign')
                ->references('id')
                ->on('fairs')
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_fair_id_foreign');
        });

        Schema::dropIfExists('products');
    }
};
