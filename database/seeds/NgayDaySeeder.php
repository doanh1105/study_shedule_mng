<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NgayDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 7; $i++){
            if($i == 7){
                DB::table('table_ngay_days')
                ->updateOrInsert(
                    ['id' => $i],
                    ['name' => 'Chủ nhật']
                );
            }
            else {
                DB::table('table_ngay_days')
                ->updateOrInsert(
                    ['id' => $i],
                    ['name' => 'Thứ '.($i + 1)]
                );
            }
        }
    }
}
