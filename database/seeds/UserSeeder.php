<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::updateOrCreate(
            ['maNguoiDung' => 'admin',],
        [              // root user
            'ho' => 'root',
            'ten' => 'admin',
            'maNguoiDung' => 'admin',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => \App\Http\Utils\AppUtils::ROLE_ADMIN,
            'id_KhoaHoc' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        factory(User::class,10)->create();
    }
}
