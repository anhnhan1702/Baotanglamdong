<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donvis', function (Blueprint $table) {
            $table->id();
            $table->string('ma')->nullable();
            $table->string('name')->nullable();
            $table->string('captren')->nullable();
            $table->string('loaidonvi')->nullable();
          
            $table->integer('thutu')->nullable();
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
        Schema::dropIfExists('donvis');
    }
}
