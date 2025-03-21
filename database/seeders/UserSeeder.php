<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = \Faker\Factory::create();

        DB::table('users')->insert([
            'name' => 'ahmed',
            'email' => 'ahmed@email.com',
            'password' => Hash::make('123456'),
        ]);
        for($x = 0;$x<10;$x++){
            DB::table('users')->insert([
                'name' =>  $faker->unique()->userName,
                'email' => Str::random(10).'@example.com',
                'password' => Hash::make('password'),
            ]);
        }
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('123456'),
            'role'=>2,
        ]);
    }
}
