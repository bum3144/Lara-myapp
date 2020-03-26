<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App\User::create([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10) . '@test.com',
        //     'password' => bcrypt('password'),
        // ]);
        
        factory(App\User::class, 5)->create();
    }
}
