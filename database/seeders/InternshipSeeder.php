<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Internship;
use Illuminate\Database\Seeder;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
     {
        // Get all the companies
        // Create between 10 to 20 internships for each company

        $companies = Company::all();

        $companies->each(function($company){
            Internship::factory()->times(mt_rand(10, 20))->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
