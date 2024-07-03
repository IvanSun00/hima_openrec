<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Major;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();
        Schema::enableForeignKeyConstraints();
        $admins =[
            [
                'name' => 'Christophorus Ivan Sunjaya',
                'email' => 'c14220210@john.petra.ac.id',
                'dept_id' => Department::where('slug', 'is')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
                'line' => 'sun_04',
            ],
            [
                'name' => 'Elizabeth Celine Liong',
                'email' => 'c14220061@john.petra.ac.id',
                'dept_id' => Department::where('slug', 'is')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
                'line' => 'ecl24',
            ],
            [ 
                'name' => 'Alexander Yofilio',
                'email' => 'c14220071@john.petra.ac.id',
                'line' => 'lio2511',
                'dept_id' => Department::where('slug', 'bph')->first()->id,
                'major_id' => Major::where('slug', 'dsa')->first()->id,
            ],
        ];

        foreach($admins as $admin){
            Admin::create($admin);
        }
    }
}
