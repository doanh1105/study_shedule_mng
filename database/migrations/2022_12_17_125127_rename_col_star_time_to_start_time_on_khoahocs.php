<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColStarTimeToStartTimeOnKhoahocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('khoa_hocs', function (Blueprint $table) {
            //
            $table->renameColumn('star_time','start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('khoa_hocs', function (Blueprint $table) {
            //
        });
    }
}
