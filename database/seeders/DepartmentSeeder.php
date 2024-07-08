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
                'name' => 'Internal Development',
                'slug' => 'id',
            ],
            [
                'name' => 'Creative n Branding',
                'slug' => 'cnb',
            ],
            [
                'name' => 'Human Resource Development',
                'slug' => 'hrd',
            ],
            [
                'name' => 'External Relationship',
                'slug' => 'xr',
            ],
            [
                'name' => 'Information System',
                'slug' => 'is',
            ],
            [
                'name' => 'Academic',
                'slug' => 'ac',
            ]
        ];

        foreach($department as $department){
            Department::create($department);
        }
    }
}
