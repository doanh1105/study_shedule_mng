<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TietHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10; $i++){
            DB::table('tiet_hoc')->updateOrInsert(
                ['id' => $i],
                [
                    'tenTietHoc' => 'Tiết '.$i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
