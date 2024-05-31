<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(UniversitySeeder::class);
        $this->call(JobSeeder::class);
        $this->call(InternshipSeeder::class);
        $this->call(JobApplicationSeeder::class);
        
        $this->call(InternshipApplicationSeeder::class);
    }
}
