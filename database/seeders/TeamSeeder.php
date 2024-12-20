<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = 2;
        for( $i = 0; $i < 10; $i++ ) {
            DB::table('teams')->insert([
                'name' =>'test',
                'leader_Id'=> 1,
                'member_Id' =>$id,

            ]);
            $id++;
    }
}
}
