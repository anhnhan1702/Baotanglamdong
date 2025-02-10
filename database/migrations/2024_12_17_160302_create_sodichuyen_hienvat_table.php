<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSodichuyenHienvatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sodichuyen_hienvat', function (Blueprint $table) {
            $table->unsignedBigInteger('sodichuyen_id'); // Sử dụng unsignedBigInteger
            $table->unsignedBigInteger('hienvat_id');
            $table->string('trangthai')->nullable();
            $table->foreign('sodichuyen_id')->references('id')->on('sodichuyenhienvats')->onDelete('cascade');
            $table->foreign('hienvat_id')->references('id')->on('hienvats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sodichuyen_hienvat');
    }
}
