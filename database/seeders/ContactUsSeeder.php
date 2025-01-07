<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {$messages = ['I have a problem when I create task', 'I can\'t\' assign tasks' , 'There is a bug in the system'];
        for($i = 1;$i<11;$i++)
        {
        DB::table('contact_us')->insert([
            'user_id' => $i,
            'email' => 'example'.rand(1,1000).'@email.com',
            'message' => ARR::random($messages)
        ]);
    }
    }
}
