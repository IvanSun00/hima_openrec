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
            [
                'date' => '2024-05-12',
            ],
            [
                'date' => '2024-05-13',
            ],
            [
                'date' => '2024-05-14',
            ],
            [
                'date' => '2024-05-15',
            ],
            [
                'date' => '2024-05-16',
            ],
            [
                'date' => '2024-05-17',
            ],
            [
                'date' => '2024-05-18',
            ],
            [
                'date' => '2024-05-19',
            ],
        ];

        foreach($date as $date){
            Date::create($date);
        }
    }
}
