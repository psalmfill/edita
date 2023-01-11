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
        if (!\App\Models\User::where('email', '=', 'admin@projects.com')->first()) {
            \App\Models\User::create([
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@projects.com',
                'password' => bcrypt('secret'),
                'account_type' => 'admin'
            ]);
        }
    }
}
