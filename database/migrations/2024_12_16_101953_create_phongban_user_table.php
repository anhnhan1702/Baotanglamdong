<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhongbanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phongban_users', function (Blueprint $table) {
            $table->unsignedInteger('user_id'); // Sử dụng unsignedBigInteger
            $table->unsignedBigInteger('phongban_id'); // Sử dụng unsignedBigInteger
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('phongban_id')->references('id')->on('phongbans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phongban_users');
    }
}
