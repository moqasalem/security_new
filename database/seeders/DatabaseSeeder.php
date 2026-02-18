<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //seed  branches and cities
        $this->call([
            CitySeeder::class,
            BranchSeeder::class,
        ]);

        // Create admin user if not exists
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'مدير النظام',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456789'),
                'mobile' => '123',
                'branch_id' => 1,
                'is_active' => true,
            ]);
        }


    }
}
