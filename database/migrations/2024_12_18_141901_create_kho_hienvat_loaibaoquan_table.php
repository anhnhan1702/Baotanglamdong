<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoHienvatLoaibaoquanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kho_hienvat_loaibaoquan', function (Blueprint $table) {
            $table->id();
            // Liên kết với bảng `sodichuyenhienvats`
            $table->unsignedBigInteger('phieubaoquan_id')->nullable();
            $table->foreign('phieubaoquan_id')->references('id')->on('phieubaoquans')->onDelete('cascade');

            // Liên kết với bảng `hienvats`
            $table->unsignedBigInteger('hienvat_id')->nullable();
            $table->foreign('hienvat_id')->references('id')->on('hienvats')->onDelete('cascade');

            // Liên kết với bảng `loai_bao_quan`
            $table->unsignedBigInteger('baoquan_id')->nullable();
            $table->foreign('baoquan_id')->references('id')->on('baoquans')->onDelete('cascade');

            // Các cột bổ sung nếu cần
            $table->string('trangthai')->nullable(); // Trạng thái liên kết
            $table->string('ghichu')->nullable(); // Trạng thái liên kết
            $table->timestamps(); // Thời gian tạo và cập nhật

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kho_hienvat_loaibaoquan');
    }
}
