<?php

namespace Database\Seeders;

use App\Enums\Category\CategoryStatus;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::insert([
            [
                'title' => 'Vlog',
                'position' => 1,
                'status' => CategoryStatus::ENABLED,
            ],
            [
                'title' => 'Sharing',
                'position' => 2,
                'status' => CategoryStatus::ENABLED,
            ],
            [
                'title' => 'Other',
                'position' => 3,
                'status' => CategoryStatus::DISABLED,
            ],
        ]);
    }
}
