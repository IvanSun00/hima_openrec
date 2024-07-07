<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Major;
use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        DB::table('candidates')->truncate();
        Schema::enableForeignKeyConstraints();
        $candidate =[
            [
                'name' => 'Timothy Vieri',
                'email' => 'c14220197@john.petra.ac.id',
                'major_id' => Major::where('slug', 'if')->first()->id,
                'gpa' => '4.00',
                'gender' => 0,
                'religion' => 'Kristen',
                'birth_place' => 'Surabaya',
                'birth_date' => '2003-08-15',
                'address' => 'Jl. Raya Darmo Permai III/1',
                'line' => 'blablabla',
                'instagram' => 'timothyGanteng24',
                'tiktok' => 'timtothyGantengLagi24',
        
                'motivation' => 'Saya ingin mengembangkan diri saya',
                'commitment' => 'Saya akan berkomitmen untuk mengikuti kegiatan WGG',
                'strength' => 'Saya memiliki kekuatan untuk mengikuti kegiatan WGG',
                'weakness' => 'Saya memiliki kelemahan untuk mengikuti kegiatan WGG',
                'experience' => 'Saya memiliki pengalaman untuk mengikuti kegiatan WGG',
                'documents' => null,
                
                'accepted_department' => null,
                'priority_department1' => Department::where('slug', 'id')->first()->id,
                'priority_department2' => Department::where('slug', 'is')->first()->id,
                'stage' => 1,
            ],
            [
                'name' => 'Daud Christian',
                'email' => 'c14220206@john.petra.ac.id',
                'major_id' => Major::where('slug', 'if')->first()->id,
                'gpa' => '4.00',
                'gender' => 0,
                'religion' => 'Kristen',
                'birth_place' => 'Surabaya',
                'birth_date' => '2003-08-29',
                'address' => 'Jl. Entah Dimana',
                'line' => 'blablabla',
                'instagram' => 'daudGanteng24',
                'tiktok' => 'daudGantengLagi24',
        
                'motivation' => 'Saya ingin mengembangkan diri saya',
                'commitment' => 'Saya akan berkomitmen untuk mengikuti kegiatan WGG',
                'strength' => 'Saya memiliki kekuatan untuk mengikuti kegiatan WGG',
                'weakness' => 'Saya memiliki kelemahan untuk mengikuti kegiatan WGG',
                'experience' => 'Saya memiliki pengalaman untuk mengikuti kegiatan WGG',
                'documents' => null,
                
                'accepted_department' => null,
                'priority_department1' => Department::where('slug', 'is')->first()->id,
                'priority_department2' => Department::where('slug', 'xr')->first()->id,
                'stage' => 1,
            ]
        ];

        foreach($candidate as $candidate){
            Candidate::create($candidate);
        }
    }
}
