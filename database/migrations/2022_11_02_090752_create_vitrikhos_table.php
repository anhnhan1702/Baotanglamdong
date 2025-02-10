<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitrikhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitrikhos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kho_id')->nullable();
            $table->string('hienvat_id')->nullable();
            $table->string('tinhtrang')->nullable();
            $table->string('soluong')->nullable();
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
        Schema::dropIfExists('vitrikhos');
    }
}
