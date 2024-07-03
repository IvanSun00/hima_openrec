<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Candidate;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Date;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('Schedules')->truncate();
        Schema::enableForeignKeyConstraints();
        $candidate = Candidate::all()->toArray();
        $time = 8;
        foreach($candidate as $candidate){
            Schedule::create([
                'admin_id' => Admin::where('name', 'Christophorus Ivan Sunjaya')->first()->id,
                'date_id' => Date::get()->first()->id,
                'candidate_id' => $candidate['id'],
                'online' => 0,
                'time' => $time++,
                'status' => 2, 
            ]);
        }
    }
}
