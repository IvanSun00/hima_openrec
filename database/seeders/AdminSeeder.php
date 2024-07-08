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
            [
                'name' => 'Euginia Gabrielle Boenadi',
                'email' => 'c14220050@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'bph')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Crisnanda Agung Salvatoni',
                'email' => 'c14220198@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'bph')->first()->id,
                'major_id' => Major::where('slug', 'sib')->first()->id,
            ],
            [
                'name' => 'Laura Wijaya Dinata',
                'email' => 'c14220192@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'bph')->first()->id,
                'major_id' => Major::where('slug', 'sib')->first()->id,
            ],
            [
                'name' => 'Javier Vittorio',
                'email' => 'c14220237@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'hrd')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Cheryl Tiffany',
                'email' => 'c14220103@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'hrd')->first()->id,
                'major_id' => Major::where('slug', 'sib')->first()->id,
            ],
            [
                'name' => 'Joyce Angelica',
                'email' => 'c14220163@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'xr')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Fernando Hose Richardy',
                'email' => 'c14220151@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'xr')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Abraham Christofer',
                'email' => 'c14220153@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'id')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Timothy Vieri Chandra',
                'email' => 'c14220197@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'id')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Gabriell Gonardo',
                'email' => 'c14220232@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'ac')->first()->id,
                'major_id' => Major::where('slug', 'sib')->first()->id,
            ],
            [
                'name' => 'Jesslyn Cynthya',
                'email' => 'c14220338@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'ac')->first()->id,
                'major_id' => Major::where('slug', 'dsa')->first()->id,
            ],
            [
                'name' => 'Sharon Naftalie',
                'email' => 'c14220101@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'cnb')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
            [
                'name' => 'Timothy Gilbert',
                'email' => 'c14220108@john.petra.ac.id',
                'line' => '',
                'dept_id' => Department::where('slug', 'cnb')->first()->id,
                'major_id' => Major::where('slug', 'if')->first()->id,
            ],
        ];

        foreach($admins as $admin){
            Admin::create($admin);
        }
    }
}
