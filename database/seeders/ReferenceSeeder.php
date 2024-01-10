<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::getData() as $data) {
            DB::table('test_references')->insert($data);
        }
    }

    public static function getData(): array
    {
        return [
            [
                'description' => 'within',
                'score' => 10,
                'icon' => 'check',
                'color' => 'green'
            ],
            [
                'description' => 'below',
                'score' => 5,
                'icon' => 'arrow-down',
                'color' => 'orange'
            ],
            [
                'description' => 'far below',
                'score' => 1,
                'icon' => 'arrow-down',
                'color' => 'red'
            ],
            [
                'description' => 'above',
                'score' => 5,
                'icon' => 'arrow-up',
                'color' => 'orange'
            ],
            [
                'description' => 'far above',
                'score' => 1,
                'icon' => 'arrow-up',
                'color' => 'red'
            ],
            [
                'description' => 'none',
                'score' => null,
                'icon' => null,
                'color' => null
            ]
        ];
    }
}
