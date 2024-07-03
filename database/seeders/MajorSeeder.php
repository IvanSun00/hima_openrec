<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Major;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('majors')->truncate();
        Schema::enableForeignKeyConstraints();
        $major=[
            [
                'name' => 'Informatika',
                'english_name' => 'Informatics',
                'slug' => 'if',
            ],
            [
                'name' => 'Sistem Informasi Bisnis',
                'english_name' => 'Business Information System',
                'slug' => 'sib',
            ],
            [
                'name' => 'Data Science and Analytics',
                'english_name' => 'Data Science and Analytics',
                'slug' => 'dsa',
            ],
        ];

        foreach($major as $major){
            Major::create($major);
        }
    }
}
