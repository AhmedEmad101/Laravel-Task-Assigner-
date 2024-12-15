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
        $Tiers = ['gold'=>100 , 'silver'=>70,'bronze'=>35];
       foreach ($Tiers as $tier => $value) {

            DB::table('tiers')->insert([
                'name' => $tier,
                'price'=>$value
                ]);
        }
    }
}
