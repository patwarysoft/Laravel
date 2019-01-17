<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('title', 50)->unique();
           //$table->string('description', 100);
            $table->float('price', 10, 2);
            $table->string('stock', 30);
            $table->string('discount', 30);
            $table->unsignedTinyInteger('unti_id');
            $table->unsignedTinyInteger('subcategory_id');
            $table->string('picture1', 100);
            $table->string('picture2', 100);
            $table->string('picture3', 100);
            $table->timestamps();
            $table->foreign('unti_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
