<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for($x = 1;$x<11;$x++){

            DB::table('tasks')->insert([
                'Creator'=>$x,
                'Project_ID'=>rand(1,10),
                'name' => $faker->sentence(3)
                ,'description' => $faker->sentence(10) ]);
        }
    }
}
