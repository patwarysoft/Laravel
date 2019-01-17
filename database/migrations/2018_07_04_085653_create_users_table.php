<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->rememberToken();
            $table->string('address', 100)->nullable();
            $table->string('type', 30)->default(1);
            $table->string('gender', 30)->nullable();
            $table->string('contact', 30)->nullable();
            $table->string('age', 40)->nullable();
            $table->unsignedTinyInteger('city_id');
            $table->string('status', 40)->nullable();
            $table->unsignedTinyInteger('provider')->default(1);
            $table->string('picture', 100)->nullable();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
