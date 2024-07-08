<?php

namespace Database\Seeders;

use App\Models\Date;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('dates')->truncate();
        Schema::enableForeignKeyConstraints();
        $date= [
            // 2024-07-09 - 2024-07-21
            // [
            //     'date' => '2024-07-09',
            // ],
            [
                'date' => '2024-07-10',
            ],
            [
                'date' => '2024-07-11',
            ],
            [
                'date' => '2024-07-12',
            ],
            [
                'date' => '2024-07-13',
            ],
            [
                'date' => '2024-07-14',
            ],
            [
                'date' => '2024-07-15',
            ],
            [
                'date' => '2024-07-16',
            ],
            [
                'date' => '2024-07-17',
            ],
            [
                'date' => '2024-07-18',
            ],
            [
                'date' => '2024-07-19',
            ],
            [
                'date' => '2024-07-20',
            ],
            [
                'date' => '2024-07-21',
            ],
        ];

        foreach($date as $date){
            Date::create($date);
        }
    }
}
