<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Applicant;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends BaseController
{
    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }

    /*
        Add new controllers
        OR
        Override existing controller here...
    */

    public static function documentTypes()
    {
        $allDocuments = array_column(DocumentType::cases(), 'value', 'name');
        return $allDocuments;
    }
    
    public function detail(Candidate $candidate)
    {
        if ($candidate->stage < 2) {
            return 'Pendaftar masih belum mengupload berkas';
        }
        $candidate->load($candidate->relations());
        $data = [
            'title' => 'Detail Pendaftar',  
            'applicant' => $candidate,
            'documentTypes' => self::documentTypes()
        ];
        return view('admin.detail', $data);
    }

    public function meetingSpot(){
        $admin = $this->getById(session('admin_id'))->toArray();
        $data['title'] = 'Meeting Spot';
        $data['admin'] = $admin;
        // dd($data);
        return view('admin.meeting-spot',$data);
    }

    public function updateMeetSpot($admin,Request $request){
        $update = [];
        if($request->meet){
            $update['meet'] = $request->meet;
            $valid = Validator::make($request->only(['meet']),[
                'meet' => 'required|url:https,http'
            ],[
                'meet.required' => 'Meeting Link is required',
                'meet.url' => 'Meeting Link must be a valid URL'
            ]);
            if($valid->fails()){
                // dd($valid->errors()->first());
                return response()->json([
                    'success' => false,
                    'message' => $valid->errors()->first()
                ],200);
            }
        }
        if($request->spot){
            $update['spot'] = $request->spot;
        }

        if($request->line){
            $update['line'] = $request->line;
        }

        $this->updatePartial($update,$admin);
        return response()->json([
            'success' => true,
            'message' => 'Data Updated'
        ],200);
    }

    // upload hasil interview
    public function hasilInterview(Candidate $candidate){
        $data['title'] = 'Upload Hasil Interview';
        $data['applicant'] = $candidate;
        $data['type'] = "hasil-interview";

        return view('admin.interview.upload-hasil',$data);
    }

}