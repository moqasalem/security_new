<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['id' => 1, 'name' => 'الرياض'],
            ['id' => 2, 'name' => 'جدة'],
            ['id' => 3, 'name' => 'الدمام'],
            ['id' => 4, 'name' => 'مكة'],
            ['id' => 5, 'name' => 'المدينة'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
