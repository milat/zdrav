<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DateFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::getData() as $data) {
            DB::table('date_formats')->insert($data);
        }
    }

    public static function getData(): array
    {
        // The first one will be the default value at users preferences
        return [
            [
                'description' => 'dd/mm/yyyy',
                'format' => 'd/m/Y'
            ],
            [
                'description' => 'yyyy-mm-dd',
                'format' => 'Y-m-d'
            ]
        ];
    }
}
