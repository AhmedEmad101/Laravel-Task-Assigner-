<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
    for($x = 0;$x<10;$x++){

        DB::table('projects')->insert([
            'Creator'=>rand(1,10),
            'title' => $faker->sentence(3)
            ,'description' => $faker->sentence(10) ]);
    }

}
    }

