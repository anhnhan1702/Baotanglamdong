<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diabans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('captren')->nullable();
            // $table->string('macaptren')->nullable();
            $table->string('code')->nullable();
            $table->string('pcode')->nullable();
            // $table->string('diaban_id')->nullable(); 
            $table->foreignId('loaidiaban')->nullable();
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
        Schema::dropIfExists('diabans');
    }
}
