<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Date;
class SubsriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = 1;
        for( $i = 0; $i < 10; $i++ ) {
            DB::table('subscriptions')->insert([
                'user_Id'=> $id,
                'tier_id'=> 1,
                'expires_at' =>Date::now()->format('Y-m-d H:i:s'),

            ]);
            $id++;
    }
    }
}
