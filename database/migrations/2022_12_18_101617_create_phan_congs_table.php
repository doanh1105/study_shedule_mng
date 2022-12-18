<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhanCongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phan_congs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_lichHoc');
            $table->integer('id_monHoc');
            $table->integer('id_user_giang_vien');
            $table->integer('id_ngayDay');
            $table->integer('id_tietHoc');
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
        Schema::dropIfExists('phan_congs');
    }
}
