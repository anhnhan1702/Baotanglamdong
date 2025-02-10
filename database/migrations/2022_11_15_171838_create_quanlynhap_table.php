<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuanlynhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quanlynhap', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('loainhap');
            $table->string('diadiem');
            $table->string('mucdichnhap')->nullable();
            $table->string('cancunhap')->nullable();
            $table->string('nguoinhap')->nullable();
            $table->string('donvinhap')->nullable();
            $table->string('nguoinhan')->nullable();
            $table->string('donvinhan')->nullable();
            $table->json('danhmuchienvat')->nullable();
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
        Schema::dropIfExists('quanlynhap');
    }
}
