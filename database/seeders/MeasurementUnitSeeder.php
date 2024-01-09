<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasurementUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::getData() as $data) {
            DB::table('measurement_units')->insert($data);
        }
    }

    public static function getData(): array
    {
        // The first one will be the default value at users preferences
        return [
            [
                'description' => 'centimeters',
                'abbreviation' => 'cm'
            ],
            [
                'description' => 'inches',
                'abbreviation' => 'in'
            ]
        ];
    }
}
