<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainBranch =
            [
                'name' => 'الفرع الرئيسي',
                'address' => 'الرياض',
                'city_id' => 1,
                'manager_id' => 1,
                'is_active' => true,
            ];

        Branch::create($mainBranch);
    }
}
