<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Candidate;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class CandidateController extends BaseController
{
    public function __construct(Candidate $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */

      // tolak-terima
    public function tolakTerima()
    {
        $data['title'] = 'Tolak Terima';
        $candidate = Candidate::with(['priorityDepartment1', 'priorityDepartment2', 'acceptedDepartment'])
            ->where('stage', '>', 3)
            ->get();
        $data['applicant'] = [];
        $i = 0;

        foreach ($candidate as $a) {
            if ($a->priorityDepartment1->id != session('department_id') && ($a->priorityDepartment2 ?  $a->priorityDepartment2->id != session('department_id') : true) && session('role') != "bph") {
                continue;
            }
            $temp = [];
            $temp['no'] = $i + 1;
            $temp['id'] = $a->id;
            $temp['nrp'] = $a->getNRP();
            $temp['name'] = $a->name;
            $temp['prioritas1'] = $a->priorityDepartment1->name;
            $temp['prioritas2'] = $a->priorityDepartment2 == null ? "---" : $a->priorityDepartment2->name;
            $temp['divisi'] = $a->acceptedDepartment;

            // button action atau acceptance status logic
            $temp['action1'] =  "
                <button
                type='button'
                class='btn-terima block mb-2 rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]'
                data-te-index='$i' data-te-priority='1' 
                >
                Terima Pilihan1
                </button>
                
                <button
                type='button'
                class='btn-tolak block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i'data-te-priority='1' 
                >
                Tolak Pilihan1
                </button>
                ";

            $temp['action2'] =  "
                <button
                type='button'
                class='btn-terima block mb-2 rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]'
                data-te-index='$i' data-te-priority='2'  
                >
                Terima Pilihan2
                </button>
                
                <button
                type='button'
                class='btn-tolak block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='2'
                >
                Tolak Pilihan2
                </button>
                ";
            if ($a->acceptance_stage == 2) {
                // diterima prioritas1
                $temp['action1'] = "<div class='text-center w-full '> 
                    <i class='fa-regular fa-circle-check fa-lg' style='color: #16a34a;'></i>        
                </div>
                <h1 class='text-green-600 font-bold text-center'>Accepted</h1>
                
                <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='1'>cancel</button>";
            } else if ($a->acceptance_stage == 3) {
                // ditolak prioritas1
                $temp['action1'] = "<div class='text-center w-full '> 
                <i class=' fa-sharp fa-regular fa-circle-xmark fa-lg' style='color: #dc2626;'></i>
                </div>
                <h1 class='text-red-600 font-bold text-center'>Tertolak</h1>
                
                <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='1'>cancel</button>";
            } else if ($a->acceptance_stage == 4) {
                // diterima prioritas 2
                $temp['action1'] = "<div class='text-center w-full '> 
                <i class=' fa-sharp fa-regular fa-circle-xmark fa-lg' style='color: #dc2626;'></i>
                </div>
                <h1 class='text-red-600 font-bold text-center'>Tertolak</h1>
                <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='1'>cancel</button>";

                $temp['action2'] = "<div class='text-center w-full '> 
                <i class='fa-regular fa-circle-check fa-lg' style='color: #16a34a;'></i>        
            </div>
            <h1 class='text-green-600 font-bold text-center'>Accepted</h1>
            
            <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='2'>cancel</button>";
            } else if ($a->acceptance_stage == 5) {
                // ditolak prioritas 2
                $temp['action1'] = "<div class='text-center w-full '> 
                <i class=' fa-sharp fa-regular fa-circle-xmark fa-lg' style='color: #dc2626;'></i>
                </div>
                <h1 class='text-red-600 font-bold text-center'>Tertolak</h1>
                <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='1'>cancel</button>";

                $temp['action2'] = "<div class='text-center w-full '> 
                <i class=' fa-sharp fa-regular fa-circle-xmark fa-lg' style='color: #dc2626;'></i>
                </div>
                <h1 class='text-red-600 font-bold text-center'>Tertolak</h1>
                <button
                type='button' class='btn-cancel mx-auto block rounded bg-danger px-2 pb-2 pt-2.5 text-[0.5rem] font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='2'>cancel</button>";
            } else if ($a->acceptance_stage == 6) {
                // terculik
                $name = $a->acceptedDepartment->slug;
                $temp['action1'] = "<div class='text-center w-full '> 
                <i class='fa-solid fa-circle-info fa-lg' style='color: #fb923c;'></i>   
                </div>
                <h1 class='text-orange-500 font-bold text-center'>Terculik $name </h1>";

                $temp['action2'] = $temp['action1'];
            }
            $data['applicant'][] = $temp;
            $i++;
        }
        $data['applicant'] = json_encode($data['applicant']);

        return view('admin.tolak_terima.tolakTerima', $data);
    }

    public function culikAnak()
    {
        $data['title'] = 'Tolak Terima';
        $candidate = Candidate::with(['priorityDepartment1', 'priorityDepartment1', 'acceptedDepartment'])
            ->where('stage', '>', 3)
            ->where('acceptance_stage', '>=', 5)
            ->get();

        $data['applicant'] = [];
        $i = 0;
        foreach ($candidate as $a) {
            $temp = [];
            $temp['no'] = $i + 1;
            $temp['id'] = $a->id;
            $temp['nrp'] = $a->getNRP();
            $temp['name'] = $a->name;
            $temp['prioritas1'] = $a->priorityDepartment1->name;
            $temp['prioritas2'] = $a->priorityDepartment2 ? $a->priorityDepartment2->name : "---";
            $temp['divisi'] = $a->acceptedDepartment;

            if ($a->acceptance_stage == 6 && $a->acceptedDepartment == session('department_id')) {
                $temp['action'] = "<button
                type='button' class='btn-cancel block rounded bg-danger px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]'
                data-te-index='$i' data-te-priority='3'>cancel</button>";
            } else if ($a->acceptance_stage == 6) {
                $name = $a->acceptedDepartment->slug;
                $temp['action'] = "<div class='text-center w-full '> 
                <i class='fa-solid fa-circle-info fa-lg' style='color: #fb923c;'></i>   
                </div>
                <h1 class='text-orange-500 font-bold text-center'>Terculik $name </h1>";
            } else {
                $temp['action'] = "<button
                type='button' class='btn-culik block mb-2 rounded bg-success px-4 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]'
                data-te-index='$i'>Culik Anak 
                </button>";
            }
            $data['applicant'][] = $temp;
            $i++;
        }
        $data['applicant'] = json_encode($data['applicant']);

        return view('admin.tolak_terima.culikAnak', $data);
    }

    public function terima(Request $request)
    {
        $data = $request->only(['id', 'priority']);
        $candidate = $this->getById($data['id']);
        $admin_department = Department::where('id', session('department_id'))->first();

        // check acceptance stage
        if ($data['priority'] == 1) {
            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment1->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk menerima pilihan 1']);
            }

            // terima prioritas 1
            if ($candidate->acceptance_stage == 1) {
                $this->updatePartial(['acceptance_stage' => 2, 'accepted_department' => $candidate->priorityDepartment1->id], $data['id']);
                return response()->json(['success' => true, 'message' => 'Berhasil menerima anak di pilihan 1']);
            }
        }

        if ($data['priority'] == 2) {
            // check apakah prioritas 2 ada
            if (!$candidate->priorityDepartment2) {
                return response()->json(['success' => false, 'message' => 'Tidak ada pilihan 2']);
            }

            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment2->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk menerima pilihan 2']);
            }

            // terima prioritas 2
            if ($candidate->acceptance_stage == 3) {
                $this->updatePartial(['acceptance_stage' => 4, 'accepted_department' => $candidate->priorityDepartment2->id], $data['id']);
                return response()->json(['success' => true, 'message' => 'Berhasil menerima anak di pilihan 2']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Gagal menerima anak']);
    }

    public function tolak(Request $request)
    {
        $data = $request->only(['id', 'priority']);
        $candidate = $this->getById($data['id']);
        $admin_department = Department::where('id', session('department_id'))->first();

        // check acceptance stage
        if ($data['priority'] == 1) {
            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment1->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk menolak pilihan 1']);
            }

            // tolak prioritas 1
            if ($candidate->acceptance_stage == 1) {
                // check apa ada prioritas2
                if ($candidate->priorityDepartment2) {
                    $this->updatePartial(['acceptance_stage' => 3], $data['id']);
                    return response()->json(['success' => true, 'message' => 'Berhasil menolak anak di pilihan 1']);
                } else {
                    $this->updatePartial(['acceptance_stage' => 5], $data['id']);
                    return response()->json(['success' => true, 'message' => 'Berhasil menolak anak di pilihan 1']);
                }
            }
        }

        if ($data['priority'] == 2) {
            // check apa ada prioritas 2
            if (!$candidate->priorityDepartment2) {
                return response()->json(['success' => false, 'message' => 'Tidak ada prioritas 2']);
            }
            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment2->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk menolak pilihan 2']);
            }

            if ($candidate->acceptance_stage == 3) {
                $this->updatePartial(['acceptance_stage' => 5], $data['id']);
                return response()->json(['success' => true, 'message' => 'Berhasil menolak anak di pilihan 2']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Gagal menolak anak']);
    }

    public function culik(Request $request)
    {
        // dia di stage 5 dan yang accept bukan bph
        $data = $request->only(['id']);
        $candidate = $this->getById($data['id']);
        if (session('role') == "bph") {
            return response()->json(['success' => false, 'message' => 'BPH tidak bisa culik anak']);
        }

        if ($candidate->acceptance_stage == 5) {
            // lakukan culik
            $role = session('role');
            $this->updatePartial(['acceptance_stage' => 6, 'accepted_department' => session('department_id')], $data['id']);
            return response()->json(['success' => true, 'message' => "Berhasil menculik ke $role"]);
        }

        return response()->json(['success' => false, 'message' => 'Gagal menculik anak']);
    }
    public function cancel(Request $request)
    {
        $data = $request->only(['id', 'priority']);
        $candidate = $this->getById($data['id']);
        $admin_department = Department::where('id', session('department_id'))->first();

        // check stage priority
        if ($data['priority'] == 1) {
            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment1->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk cancel pilihan 1']);
            }

            // APAKAH ADA PRIORITAS 2
            if ($candidate->priorityDepartment2) {
                // kalau ada cancel
                if ($candidate->acceptance_stage <= 3 && $candidate->acceptance_stage >= 2) {
                    $this->updatePartial(['acceptance_stage' => 1, 'accepted_department' => null], $data['id']);
                    return response()->json(['success' => true, 'message' => 'Berhasil cancel anak di pilihan 1']);
                }
            } else {
                // kalau tidak ada cancel
                if ($candidate->acceptance_stage <= 5 && $candidate->acceptance_stage >= 2) {
                    $this->updatePartial(['acceptance_stage' => 1, 'accepted_department' => null], $data['id']);
                    return response()->json(['success' => true, 'message' => 'Berhasil cancel anak di pilihan 1']);
                }
            }
        } else if ($data['priority'] == 2) {
            // check apa ada prioritas 2
            if (!$candidate->priorityDepartment2) {
                return response()->json(['success' => false, 'message' => 'Tidak ada prioritas 2']);
            }

            // check apakah punya kuasa
            if ($admin_department->id != $candidate->priorityDepartment2->id && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk cancel pilihan 2']);
            }

            // cancel prioritas 2
            if ($candidate->acceptance_stage <= 5 && $candidate->acceptance_stage >= 4) {
                $this->updatePartial(['acceptance_stage' => 3, 'accepted_department' => null], $data['id']);
                return response()->json(['success' => true, 'message' => 'Berhasil cancel anak di pilihan 2']);
            }
        }

        //untuk culik
        else if ($data['priority'] == 3) {
            // check apakah punya kuasa
            if ($admin_department->id != $candidate->accepted_department && $admin_department->slug != "bph") {
                return response()->json(['success' => false, 'message' => 'Anda tidak memiliki kuasa untuk cancel anak']);
            }

            // cancel culik
            if ($candidate->acceptance_stage == 6) {
                $this->updatePartial(['acceptance_stage' => 5, 'accepted_department' => null], $data['id']);
                return response()->json(['success' => true, 'message' => 'Berhasil cancel anak']);
            }
        }

        return response()->json(['success' => false, 'message' => 'Gagal cancel anak, Tidak di stage yang tepat']);
    }

    public function getAccepted()
    {
        $accepted = Candidate::with(['acceptedDepartment', 'major'])->where('accepted_department', '!=', null)->get()->toArray();
        $data['title'] = 'Accepted';
        $temp = [
            'is' => [],
            'id' => [],
            'cnb' => [],
            'hrd' => [],
            'xr' => [],
            'ac' => [],
        ];
        foreach ($accepted as $a) {
            $temp[$a['accepted_department']['slug']][] = [
                'nrp' => substr($a['email'], 0, 9),
                'name' => $a['name'],
                'address' => $a['address'],
                'type' => $a['acceptance_stage'],
                'stage' => $a['stage'],
                'gpa' => $a['gpa'],
                'major' => $a['major']['english_name'],
                'link' => route('admin.candidate.cv', $a['id']),
            ];
        }
        $data['accepted'] = json_encode($temp);
        return view('admin.tolak_terima.accepted', $data);
    }




}

enum DocumentType: String
{
    case Photo = 'Foto Diri 3x4';
    case Ktm = 'KTM / Profile Petra Mobile';
    case Grades = 'Transkrip Nilai';
    case Skkk = 'Transkrip SKKK Petra Mobile';
    case Schedule = 'Jadwal Kuliah';
}