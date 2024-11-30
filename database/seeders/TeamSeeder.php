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
        $id = 1;
        for( $i = 0; $i < 10; $i++ ) {
            DB::table('teams')->insert([
                'id'=> $id,
                'Leader_Id'=> $id,
                'Project_Id' =>$id
            ]);
            $id++;
    }
}
}
