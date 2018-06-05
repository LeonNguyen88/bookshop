<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$this->call(UserSeeder::class);*/
        //factory(App\User::class, 20)->create();
        //$this->call(RoleSeeder::class);
        factory(App\Review::class, 300)->create();
        /*factory(App\Post::class, 3)->create();*/
    }
}
