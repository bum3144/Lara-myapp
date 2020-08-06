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
        App\User::truncate();
        
        factory(App\User::class)->create([
            // 'name' => Str::random(10),
            // 'email' => Str::random(10) . '@test.com',
            // 'password' => bcrypt('password'),
            'name' => 'test1',
            'email' => 'test1@test.com',
            'activated' => 1
        ]);
        factory(App\User::class)->create([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'activated' => 1
        ]);
        
        factory(App\User::class, 5)->create();
    }
}
