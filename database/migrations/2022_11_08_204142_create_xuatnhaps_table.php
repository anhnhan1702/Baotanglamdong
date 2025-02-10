<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXuatnhapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xuatnhaps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('loaixuatnhap')->nullable();
            $table->string('diadiem')->nullable();
            $table->string('mucdichxuat')->nullable();
            $table->string('cancuxuat')->nullable();
            $table->string('nguoixuat')->nullable();
            $table->string('donvixuat')->nullable();
            $table->string('nguoinhan')->nullable();
            $table->string('donvinhan')->nullable();
            $table->date('thoigiantra')->nullable();
            $table->string('danhmucxuat')->nullable();
            $table->string('trungbay_id')->nullable();
            $table->json('danhmuchienvat')->nullable();
            $table->json('hienvatdatra')->nullable();
            $table->json('hienvats_id')->nullable();
            $table->string('soluong')->nullable();
            $table->string('trangthai')->nullable();
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
        Schema::dropIfExists('xuatnhaps');
    }
}
