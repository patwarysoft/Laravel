<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_details', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->unsignedTinyInteger('sales_id');
            $table->unsignedTinyInteger('product_id');
            $table->string('quantity', 20);
            $table->unsignedTinyInteger('price');
            $table->unsignedTinyInteger('discount');
            $table->timestamps();
            $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('price')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('discount')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_details');
    }
}
