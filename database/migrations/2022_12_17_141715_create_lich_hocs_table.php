<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichHocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_hocs', function (Blueprint $table) {
            $table->id();
            $table->string('tenLichHoc');
            $table->integer('id_khoaHoc');
            $table->integer('id_nganhHoc');
            $table->date('ngayBatDau');
            $table->date('ngayKetThuc');
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
        Schema::dropIfExists('lich_hocs');
    }
}
