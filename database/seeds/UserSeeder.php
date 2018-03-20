<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            ['name' => 'Admin',
            'email' => 'n.anhtuan0808@gmail.com',
            'phone' => '01205491108',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
            'realname' => 'Nguyễn Anh Tuấn',
            'address' => '343/22 Nguyễn Trọng Tuyển, phường 1, quận Tân Bình, TPHCM',
            'level' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);

    }
}
