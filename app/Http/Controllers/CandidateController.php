<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Candidate;
use App\Models\Department;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use ErrorException;
// http
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ApplicationRequest;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Http\UploadedFile;
use App\Events\ApplicantDocumentsUploaded;
use App\Http\Requests\PickScheduleRequest;
use App\Models\Admin;
use App\Models\Date;
use App\Models\Schedule;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;
use Sabberworm\CSS\Settings;

class CandidateController extends BaseController
{
    public function __construct(Candidate $model)
    {
        parent::__construct($model);
    }
    /*
    |--------------------------------------------------------------------------
    | Main Page
    */

    // tahap 1
    public function applicationForm()
    {
        $data['title'] = 'Form Pendaftaran';
        $data['religions'] = self::religions();

        $department = Department::all(['id', 'name'])->toArray();
        // $department = Department::where('slug', 'peran')->get(['id', 'name'])->toArray();
        $excludedDivisions = ['Badan Pengurus Harian', 'Opening', 'Closing'];
        $data['departments'] = array_filter($department, function ($division) use ($excludedDivisions) {
            return !in_array($division['name'], $excludedDivisions);
        });
        $nrp = strtolower(session('nrp'));
        $res = Http::get('http://john.petra.ac.id/~justin/finger.php?s=' . $nrp);

        $data['form'] = [];
        try {
            $resJson = $res->json('hasil')[0];
            $data['form']['name'] = ucwords(strtolower($resJson['nama']));
            $data['form']['email'] = $nrp . '@john.petra.ac.id';
            $data['form']['stage'] = 0;
        } catch (ErrorException $e) {
            Log::warning('NRP {nrp} not found in john API.', ['nrp' => $nrp]);
        }

        $data['majors'] = Major::select('id', 'name')->get();

        $applicantData = $this->model->findByNRP($nrp);
        if ($applicantData) {
            $data['form'] = $applicantData->toArray();
        }
        return view('main.application_form', $data);
    }

    public function storeApplication(ApplicationRequest $request)
    {
        $msg = $this->store($request);

        return redirect()->back()
            ->with('success', 'Pendaftaran berhasil!')
            ->with('message', $msg);
    }

    public function updateApplication(ApplicationRequest $request)
    {
        $applicant = $this->model->findByEmail(session('email'));
        $this->updatePartial($request->except(['_token', '_method']), $applicant->id);


        return redirect()->back()
            ->with('success_update', 'Biodata berhasil diubah!');
    }

    // tahap2
    public function documentsForm()
    {
        $nrp = strtolower(session('nrp'));
        $applicant = $this->model->findByEmail(
            $nrp . '@john.petra.ac.id',
            ['id', 'documents', 'stage']
        );

        if (!$applicant)
            return redirect()->route('applicant.application-form')
                ->with('previous_stage_not_completed', 'Silahkan isi form pendaftaran terlebih dahulu!');

        $data['title'] = 'Upload Berkas';
        $data['documentTypes'] = self::documentTypes();
        $data['list_image'] = ['Photo','Ktm'];


        $data['applicant'] = $applicant->toArray();
        return view('main.documents_form', $data);
    }

    public function storeDocument(StoreDocumentRequest $request, $type)
    {
        $nrp = strtolower(session('nrp'));
        $applicant = $this->model->findByNRP($nrp);
        $storeName = self::saveFile($request->file($type), $applicant, $type);

        if (!$storeName) {
            return response()
                ->json(['message' => 'Failed to upload file. Please try again!'])
                ->setStatusCode(500);
        }

        $applicant->addDocument($type, $storeName);
        ApplicantDocumentsUploaded::dispatch(
            $applicant,
            self::documentTypes()
        );

        $applicant->refresh();

        return response()
            ->json([
                'message' => 'File uploaded successfully!',
                'type' => $type,
                'stageCompleted' => $applicant->stage > 1
            ])
            ->setStatusCode(201);
    }

    private static function saveFile(UploadedFile $file, Candidate $applicant, $type)
    {
        $type = strtolower($type);
        $nrp = $applicant->getNRP();
        $timestamp = time();

        $path = 'public/uploads/' . $type;
        $storeName = sprintf('%s_%s_%d.%s', $nrp, $type, $timestamp, $file->extension());

        $filePath = $file->storePubliclyAs($path, $storeName);

        return ($filePath) ? $storeName : false;
    }
    

    // tahap 3
    public function scheduleForm()
    {
        $data['title'] = 'Pilih Jadwal Interview';

        $applicant = Candidate::with(['priorityDepartment1', 'priorityDepartment2'])
            ->where('email', session('email'))
            ->where('stage', '>=', 2)
            ->first();

        if (!$applicant)
            return redirect()->route('applicant.documents-form')
                ->with('previous_stage_not_completed', 'Silahkan upload berkas Anda terlebih dahulu!');


        $data['double_interview'] = false;
        if ($applicant->stage >= 3) {
            $data['read_only'] = true;
            $data['schedules'] = Schedule::with('date')->with('admin')
                ->where('candidate_id', $applicant->id)
                ->get()
                ->toArray();

            //reschedule
            $reschedule = [];

            foreach ($data['schedules'] as $i => $schedule) {
                // $reschedule[$i] = $this->canReschedule($schedule['date']['date'], $schedule['time']);
                $reschedule[$i] = false;
            }

            // dd($reschedule);

            $data['reschedule'] = $reschedule;
        } else
            $data['read_only'] = false;

        $data['applicant'] = $applicant->toArray();

        $lastHourToPickNextDay = 21;
        if ($data['read_only']) {
            $data['dates'] = Date::all()->toArray();
        } else if ($data['read_only'] || now()->hour < $lastHourToPickNextDay) {
            // $data['dates'] = Date::select('id', 'date')->where('date', '>', Carbon::now())->get()->toArray();
            $data['dates'] = Date::select('id', 'date')->where('date', '>', Carbon::yesterday())->get()->toArray();
        } else {
            // $data['dates'] = Date::select('id', 'date')->where('date', '>', Carbon::tomorrow())->get()->toArray();
            $data['dates'] = Date::select('id', 'date')->where('date', '>', Carbon::now())->get()->toArray();
        }

        // dd($data);

        return view('main.schedule_form', $data);
    }

    public function getTimeSlot(Request $request)
    {
        $date = $request->date;
        $online = intval($request->online);
        $division = $request->division;
        $isBphEnabled = true;
        // $isBphEnabled = Setting::where('key', 'BPH')->first()->value == 1;

        if ($isBphEnabled) $bph = Department::where('name', 'Badan Pengurus Harian')->first();

        $interviewers = Admin::whereIn('dept_id', $isBphEnabled ? [$division, $bph->id] : [$division])->get();

        $schedules = Schedule::select('time')
            ->where([
                'date_id' => $date,
                'status' => 1,
            ])
            ->whereIn('online', $online === 1 ? [0, 1] : [0]) //ini ga kebalik ta
            ->whereIn('admin_id', $interviewers->pluck('id'))
            ->groupBy('time')
            ->orderBy('time', 'asc')
            ->pluck('time');

        return response()->json(['success' => true, 'data' => $schedules]);
    }

    public function pickSchedule(PickScheduleRequest $request)
    {
        $validated = $request->validated();
        $applicant = Candidate::where('email', session('email'))->first();
        
        // apakah sudah pernah isi
        $schedule = Schedule::where('candidate_id', $applicant->id)->first();
        if ($schedule) {
            return redirect()->back()->with('error', 'Anda sudah memilih jadwal interview!');
        }
        
        $pickedSchedule = [];

        // get available schedules
        $schedules = Schedule::join('admins', 'schedules.admin_id', '=', 'admins.id')
            ->select('schedules.id', 'schedules.admin_id', 'schedules.date_id', 'schedules.time', 'schedules.online')
            ->where([
                'admins.dept_id' => $validated['division'][0],
                'date_id' => $validated['date_id'],
                'time' => $validated['time'],
                'status' => 1,
            ])
            // ->whereIn('online', $validated['online'][$i] == 1 ? [0, 1] : [0])
            ->get();

        // dd($schedules);

        // choose interviewer from selected division
        $admin = $this->chooseInterviewer($schedules->pluck('admin_id'));
        // dd($admin);

        // if still there's none, pick interviewer from bph division
        if (!$admin) {
            $bph = Department::where('name', 'Badan Pengurus Harian')->first();

            $schedules = Schedule::join('admins', 'schedules.admin_id', '=', 'admins.id')
                ->select('schedules.id', 'schedules.admin_id', 'schedules.date_id', 'schedules.time', 'schedules.online')
                ->where([
                    'admins.dept_id' => $bph->id,
                    'date_id' => $validated['date_id'],
                    'time' => $validated['time'],
                    'status' => 1,
                ])
                // ->whereIn('online', $validated['online'][$i] == 1 ? [0, 1] : [0])
                ->get();

            $admin = $this->chooseInterviewer($schedules->pluck('admin_id'));
        }

        $pickedSchedule[] = $schedules->where('admin_id', $admin->admin_id)->first();        

        DB::beginTransaction();
        try {
            // update schedule and applicant stage
            $this->updatePartial(['stage' => 3], $applicant->id);

            foreach ($pickedSchedule as $key => $value) {
                $schedule = Schedule::where('id', $value->id)->lockForUpdate()->first();

                $schedule->status = 2;
                $schedule->online = $validated['online'];
                $schedule->candidate_id = $applicant->id;
                $schedule->save();

                $data['schedules'][] = $schedule->load(['admin', 'date']);
            }

            $data['applicant'] = $applicant->load(['priorityDepartment1', 'priorityDepartment2']);
            
            // dapet email lek ada yg daftar (skip sek)
            // $emailSettings = Setting::where('key', 'Email')->first();
            // // dd($emailSettings);
            // if ($emailSettings->value == 1) {
            //     $userMailer = new MailController(new scheduleMail($data));
            //     // $userMailer->sendMail($data);
            //     $data['to'] = $applicant->email;
            //     dispatch(new SendMailJob($userMailer, $data));

            //     foreach ($data['schedules'] as $s) {
            //         $adminMailer = new MailController(new adminMail([
            //             'schedules' => $s,
            //             'applicant' => $data['applicant']
            //         ]));
            //         $data['to'] = $s->admin->email;
            //         // $adminMailer->sendMail($data);
            //         dispatch(new SendMailJob($adminMailer, $data));
            //     }

            //     DB::commit();
            //     return redirect()->back()->with('success', 'Jadwal interview berhasil dipilih!');
            // }

            DB::commit();
            return redirect()->back()->with('success', 'Jadwal interview berhasil dipilih!');
        } catch (Exception $e) {
            // dd($e);
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan! Silahkan coba lagi');
        }
    }

    public function chooseInterviewer(Collection $admin_id)
    {
        // favor interviewer that haven't interview anyone
        $admin = Schedule::select('admin_id')
            ->whereIn('admin_id', $admin_id)
            ->whereNotExists(function ($query) {
                $query->select("*")
                    ->from('schedules as s')
                    ->whereColumn('s.admin_id', 'schedules.admin_id')
                    ->where('s.status', 2);
            })
            ->groupBy('admin_id')
            ->first();

        // if there's none, pick interviewer with least interviewees
        if (!$admin) {
            $admin = Schedule::select('admin_id', DB::raw("COUNT(*) as count"))
                ->whereIn('admin_id', $admin_id)
                ->where('status', 2)
                ->groupBy('admin_id')
                ->orderBy('count', 'asc')
                ->first();
        }

        return $admin;
    }

    // public function reschedule(Request $request)
    // {
    //     $schedule_id = $request->schedule_id;
    //     $email = session('email');

    //     $applicant = $this->model->findByEmail($email);
    //     $schedule = $applicant->schedules()->where('id', $schedule_id);

    //     if ($schedule) {
    //         $schedule = $schedule->with('date')->first();
    //         $reschedule_status = $applicant->reschedule;

    //         //check current time
    //         if (!$this->canReschedule($schedule->date->date, $schedule->time)) {
    //             return redirect()->back()->with('error', 'Tidak dapat mengganti jadwal karena telah melebihi batas waktu');
    //         }

    //         $index = $schedule->type == 2 ? 1 : 0; //index for reschedule status to update

    //         //check already request reschedule
    //         if ($reschedule_status[$index] > 0) {
    //             return redirect()->back()->with('success_confirm', 'Pengajuan ganti jadwal sudah diajukan. Silahkan menghubungi contact person untuk menentukan jadwal terbaru.');
    //         }

    //         //update reschadule status
    //         $applicant->reschedule = $index == 0 ? "1" . $reschedule_status[1] : $reschedule_status[0] . "1";
    //         $applicant->save();

    //         $data['applicant'] = $applicant->load(['priorityDivision1', 'priorityDivision2']);
    //         $data['schedules'] = $schedule->load(['admin', 'date']);
    //         $data['to'] = $schedule->admin->email;

    //         $emailSettings = Setting::where('key', 'Email')->first();

    //         if ($emailSettings->value == 1) {
    //             $rescheduleMailer = new MailController(new rescheduleMail($data));
    //             dispatch(new SendMailJob($rescheduleMailer, $data));
    //         }

    //         return redirect()->back()->with('success_confirm', 'Pengajuan ganti jadwal sudah diajukan. Silahkan menghubungi contact person untuk menentukan jadwal terbaru.');
    //     }

    //     return redirect()->back()->with('error', 'Terjadi kesalahan! Silahkan coba lagi');
    // }

    // public function canReschedule($date, $time)
    // {
    //     return true;
        
    //     date_default_timezone_set('Asia/Jakarta');

    //     //max date to reschedule
    //     $tolerate = "-1 day +20 hours";                     //1 day before schedule and close at 20:00
    //     // $tolerate = "-1 day +" . $time ." hours";       //exactly 24 hours before schedule

    //     $current_date = date('Y-m-d H:i:s');
    //     $max_date = date("Y-m-d H:i:s", strtotime($tolerate, strtotime($date)));

    //     return $current_date < $max_date;
    // }




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



    // internal fucnction
    private static function religions()
    {
        return array_column(Religion::cases(), 'name');
    }

    public static function documentTypes()
    {
        $allDocuments = array_column(DocumentType::cases(), 'value', 'name');
        return $allDocuments;
    }

    // private static function saveFile(UploadedFile $file, Applicant $applicant, $type)
    // {
    //     $type = strtolower($type);
    //     $nrp = $applicant->getNRP();
    //     $timestamp = time();

    //     $path = 'public/uploads/' . $type;
    //     $storeName = sprintf('%s_%s_%d.%s', $nrp, $type, $timestamp, $file->extension());

    //     $filePath = $file->storePubliclyAs($path, $storeName);

    //     return ($filePath) ? $storeName : false;
    // }

}

enum DocumentType: String
{
    case Photo = 'Foto Diri 3x4';
    case Ktm = 'KTM / Profile Petra Mobile';
    case Transkrip = 'Transkirp Nilai, SKKK, Bukti Kecurangan';
    case CV = 'CV';
    case MBTI = 'MBTI Test';
    case DISC = 'DISC Test';
}

enum Religion
{
    case Buddha;
    case Hindu;
    case Islam;
    case Katolik;
    case Konghucu;
    case Kristen;
}