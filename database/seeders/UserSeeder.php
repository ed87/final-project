<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
        DB::table('users')->truncate();

        User::factory()->times(50)->create();

        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'user_type' => User::TYPE_ADMIN,
        ]);

        User::factory()->create([
            'username' => 'Company',
            'email' => 'company@example.com',
            'user_type' => User::TYPE_COMPANY,
        ]);

        User::factory()->create([
            'username' => 'Applicant',
            'email' => 'applicant@example.com',
            'user_type' => User::TYPE_APPLICANT,
        ]);

        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::statement('PRAGMA foreign_keys=ON;');
    }
}
