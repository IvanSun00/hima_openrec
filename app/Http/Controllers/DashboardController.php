<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Candidate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = "Dashboard";
        $data['departments'] = Department::whereNotIn('name', ['Badan Pengurus Harian'])
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.dashboard', $data);
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        if ($id == 'all') {
            for ($i = 1; $i < 4; $i++) {
                $data[] = Candidate::where('stage', '>=', $i)->get()->count();
            }
        }
        else {
            for ($i = 1; $i < 4; $i++) {
                $data[] = Candidate::where('stage', '>=', $i)
                    ->where(function ($q) use ($id) {
                        $q->where('priority_department1', $id)
                            ->orWhere('priority_department2', $id);
                    })
                    ->get()
                    ->count();
            }
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
