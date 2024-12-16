<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $this->call(UserSeeder::class);
       $this->call(ProjectSeeder::class);
       $this->call(TaskSeeder::class);
       $this->call(TeamSeeder::class);
       $this->call(DeadlineSeeder::class);
       $this->call(TierSeeder::class);
       $this->call(SubsriptionSeeder::class);
       $this->call(WorkOnSeeder::class);
    }
}
