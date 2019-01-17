<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reviews', function (Blueprint $table) {
            $table->tinyIncrements('id');
           
            $table->unsignedTinyInteger('user_id');
            $table->unsignedTinyInteger('sale_id');
            $table->string('date', 20);
            $table->string('rating', 50);
            $table->string('comment', 100);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_reviews');
    }
}
