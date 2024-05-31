<?php

namespace Database\Seeders;

use App\Models\University;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
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
        DB::table('universities')->truncate();

        // Get all the users who are of type_company
        $users_of_type_admin = User::where('user_type', User::TYPE_ADMIN)->get();

        $users_of_type_admin->each(function($user){
            University::factory()->make([
                'user_id' => $user->id,
            ])->save();
        });

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('PRAGMA foreign_keys=ON;');
        
    }
}
