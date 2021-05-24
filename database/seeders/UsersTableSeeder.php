<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test5', // sprintf('%s %s', str_random(3), str_random(5))
            'email' => 'test5@test.com', // str_random(10).'@test.com'
            'password' => bcrypt('password'),
        ]);
    }
}
