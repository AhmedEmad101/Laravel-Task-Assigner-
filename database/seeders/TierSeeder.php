<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Tiers = ['Gold' , 'silver','bronze'];
       foreach ($Tiers as $tier) {

            DB::table('tiers')->insert([
                'name' => $tier
                ]);
        }
    }
}
