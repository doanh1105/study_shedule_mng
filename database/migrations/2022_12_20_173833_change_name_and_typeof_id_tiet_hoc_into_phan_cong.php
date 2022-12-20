<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeNameAndTypeofIdTietHocIntoPhanCong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phan_congs', function (Blueprint $table) {
            //
            $table->longText('ids_tietHoc');
            $table->dropColumn('id_tietHoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phan_congs', function (Blueprint $table) {
            //
        });
    }
}
