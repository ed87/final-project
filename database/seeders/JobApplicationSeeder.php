<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('PRAGMA foreign_keys=OFF;');
        DB::table('job_applications')->truncate();

        // Get all the users of type applicant
        // Let each applicant apply to 0 or more jobs

        $applicants = User::where('user_type', User::TYPE_APPLICANT)->get();
        $jobs = Job::with('company')->get();

        $applicants->each(function($applicant) use ($jobs) {
            $jobs_to_apply_to = $jobs->random(mt_rand(0, 12));
            $jobs_to_apply_to->each(function($job_to_apply_to) use($applicant) {
                $applicant->jobApplications()->attach($job_to_apply_to, [
                    'company_id' => $job_to_apply_to->company_id,
                    'cv_file' => 'example_cv.txt'
                ]);
            });
        });
        
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('PRAGMA foreign_keys=ON;');
    }
}
