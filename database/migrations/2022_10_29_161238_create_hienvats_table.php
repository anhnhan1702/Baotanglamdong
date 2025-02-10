<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHienvatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hienvats', function (Blueprint $table) {
            $table->id();
            // Tên gọi
            // $table->string('ma');
            $table->string('name');
            $table->string('ten_khac')->nullable();
            $table->string('so_ky_hieu')->nullable();
            $table->string('soluong')->nullable();
            $table->string('sothanhphan')->nullable();
            $table->string('chu_nhan')->nullable();
            $table->string('dia_diem_st')->nullable();
            $table->string('hinhthucst_id')->nullable();
            $table->string('thoi_gian_st')->nullable();
            $table->string('chatlieu_id')->nullable();
            $table->string('mau_sac')->nullable();
            $table->string('kich_thuoc')->nullable();
            $table->string('trong_luong')->nullable();
            $table->string('hinh_dang')->nullable();
            $table->string('ky_thuat_ct')->nullable();
            $table->string('tinh_trang_hv')->nullable();
            $table->date('tg_nhap_kho')->nullable();
            $table->string('loaihienvat_id')->nullable();
            $table->string('nguon_goc')->nullable();
            $table->string('dudoan_niendai')->nullable();
            $table->string('baoquan_phucche')->nullable();
            $table->string('vitrihv_id')->nullable();
            $table->string('bosuutap_id')->nullable();
            $table->string('kho_id')->nullable();
            $table->string('ghinho')->nullable();
            $table->longText('mota')->nullable();
            $table->json('ghichu')->nullable();
            $table->string('xuatnhap_id')->nullable();
            $table->string('checkxuatnhap')->nullable();
            $table->string('uuid')->nullable();
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
        Schema::dropIfExists('hienvats');
    }
}
