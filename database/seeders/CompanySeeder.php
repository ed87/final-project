<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
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
        DB::table('companies')->truncate();

        // Get all the users who are of type_company
        $users_of_type_company = User::where('user_type', User::TYPE_COMPANY)->get();

        $users_of_type_company->each(function($user){
            Company::factory()->make([
                'user_id' => $user->id,
            ])->save();
        });

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('PRAGMA foreign_keys=ON;');
    }
}
