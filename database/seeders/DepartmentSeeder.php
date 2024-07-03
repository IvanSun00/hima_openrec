<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('departments')->truncate();
        Schema::enableForeignKeyConstraints();
        $department =[
            [
                'name' => 'Badan Pengurus Harian',
                'slug' => 'bph',
            ],
            [
                'name' => 'Academic and Education',
                'slug' => 'ae',
            ],
            [
                'name' => 'Global Affairs',
                'slug' => 'ga',
            ],
            [
                'name' => 'Talent Navigator',
                'slug' => 'tn',
            ],
            [
                'name' => 'Artistry Creator',
                'slug' => 'ac',
            ],
            [
                'name' => 'Information System',
                'slug' => 'is',
            ]
        ];

        foreach($department as $department){
            Department::create($department);
        }
    }
}
