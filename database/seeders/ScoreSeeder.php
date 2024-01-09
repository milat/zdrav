<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::getData() as $data) {
            DB::table('scores')->insert($data);
        }
    }

    public static function getData(): array
    {
        return [
            [
                'value' => 1,
                'description' => 'awful',
                'color' => '#FADBD8'
            ],
            [
                'value' => 2,
                'description' => 'bad',
                'color' => '#FAE5D3'
            ],
            [
                'value' => 3,
                'description' => 'neutral',
                'color' => '#FCF3CF'
            ],
            [
                'value' => 4,
                'description' => 'good',
                'color' => '#D0ECE7'
            ],
            [
                'value' => 5,
                'description' => 'great',
                'color' => '#D5F5E3'
            ]
        ];
    }
}
