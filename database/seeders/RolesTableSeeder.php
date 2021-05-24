<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleNames = ['teacher', 'salesman', 'director', 'programmer'];
        foreach ($roleNames as $roleName)
        {
            DB::table('roles')->insert([
                'name'=>$roleName,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);
        }
    }
}
