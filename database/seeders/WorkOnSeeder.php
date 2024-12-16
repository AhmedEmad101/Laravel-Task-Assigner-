<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WorkOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $id = 1;
        for( $i = 0; $i < 10; $i++ ) {
            DB::table('work_ons')->insert([
                'user_Id'=> $id,
                'project_id' =>$id,
                'task_id' =>$id
            ]);
            $id++;
    }
}
}
