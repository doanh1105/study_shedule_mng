<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NganhHocSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nganh_hoc')->updateOrInsert(
            ['id' => 1],
            [
            'maNganhHoc' => '695105003SPT',
            'tenNganhHoc' => 'Sư phạm Tin học',
            ]
        );

        DB::table('nganh_hoc')->updateOrInsert(
            ['id' => 2],
            [
            'maNganhHoc' => '695105003CNT',
            'tenNganhHoc' => 'Công nghệ thông tin',
            ]
        );

        DB::table('nganh_hoc')->updateOrInsert(
            ['id' => 3],
            [
            'maNganhHoc' => '695105003SPT-TA',
            'tenNganhHoc' => 'Sư phạm Tin - dạy bằng tiếng Anh',
            ]
        );
    }
}
