<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::getData() as $data) {
            DB::table('meal_types')->insert($data);
        }
    }

    public static function getData(): array
    {
        return [
            [
                'description' => 'breakfast'
            ],
            [
                'description' => 'lunch'
            ],
            [
                'description' => 'dinner'
            ],
            [
                'description' => 'snack'
            ]
        ];
    }
}
