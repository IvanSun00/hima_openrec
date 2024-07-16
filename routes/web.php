<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;
use App\Models\Candidate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main.home');
})->name('home');

// Auth
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/loginRedirect', [AuthController::class , 'loginRedirect'])->name('google.redirect');
Route::get('/loginProcess', [AuthController::class , 'loginProcess'])->name('google.callback');
Route::get('/loginTesting', [AuthController::class , 'loginTesting']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login/{nrp}/secret/{secret}', [AuthController::class, 'loginPaksa'])->name('loginPaksa');
Route::get('/assets/upload/{path}', [AssetController::class, 'upload'])->where('path', '.*')->name('upload');


// admin page
Route::prefix('admin')->middleware(['session','admin'])->group(function () {
    // Route::get('/dashboard', function () {
    //     $data['title'] = "Dashboard";
    //     return view('admin.dashboard',$data);
    // })->name('admin.dashboard');

    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/realtime', [DashboardController::class, 'getData'])->name('admin.dashboard.getData');

    // Dates
    Route::prefix('dates')->middleware('role:is,bph')->group(function () {
        Route::get('/', [DateController::class, 'index'])->name('admin.date');
        Route::post('/', [DateController::class, 'add'])->name('admin.date.add');
        Route::delete('/{id}', [DateController::class, 'destroy'])->name('admin.date.delete');
    });

    // select schedules
    Route::prefix('schedules')->group(function () {
        Route::get('/select-schedule', [ScheduleController::class, 'index'])->name('admin.select.schedule');
        Route::patch('/select-schedule', [ScheduleController::class, 'select'])->name('admin.select.schedule.update');
    });

    // interview
    Route::prefix('interview')->group(function () {
        Route::get('/', [ScheduleController::class, 'departmentInterview'])->name('admin.interview');
        Route::post('/division', [ScheduleController::class, 'scheduleDepartment'])->name('admin.interview.department');
        Route::get('/my', [ScheduleController::class, 'myInterview'])->name('admin.interview.my');
        Route::post('/kidnap', [ScheduleController::class, 'kidnap'])->name('admin.interview.kidnap');
        // Route::get('/reschedule', [ScheduleController::class, 'myReschedule'])->name('admin.interview.my-reschedule');
        // Route::post('/reschedule', [ScheduleController::class, 'reschedule'])->name('admin.interview.reschedule');

        // upload hasil interview
        Route::get('/upload/{candidate}', [AdminController::class, 'hasilInterview'])->name('admin.interview.start');
        Route::post('store-interview/{candidate}', [AdminController::class, 'storeHasilInterview'])->name('admin.interview.store');
        // store comment
        Route::post('/comment/{candidate}', [AdminController::class, 'storeComment'])->name('admin.interview.comment');

    });


    //meeting-spot
    Route::prefix('meeting-spot')->group(function () {
        Route::get('/', [AdminController::class, 'meetingSpot'])->name('admin.meeting-spot');
        Route::patch('/{admin}', [AdminController::class, 'updateMeetSpot'])->name('admin.meeting-spot.update');
    });

    // acceptance, tolak-terima anak
    Route::prefix('tolak-terima')->group(function () {
        Route::get('/', [CandidateController::class, 'tolakTerima'])->name('admin.tolak-terima');
        Route::get('/culikAnak', [CandidateController::class, 'culikAnak'])->name('admin.tolak-terima.culikAnak');
        Route::get('/accepted', [CandidateController::class, 'getAccepted'])->name('admin.tolak-terima.accepted');
        Route::post('/tolak', [CandidateController::class, 'tolak'])->name('admin.tolak-terima.tolak');
        Route::post('/terima', [CandidateController::class, 'terima'])->name('admin.tolak-terima.terima');
        Route::post('/culik', [CandidateController::class, 'culik'])->name('admin.tolak-terima.culik');
        Route::post('/cancel', [CandidateController::class, 'cancel'])->name('admin.tolak-terima.cancel');
    });


    // detail candidate (done)
    Route::get('/detail/{candidate}', [AdminController::class, 'detail'])->name('admin.candidate.detail');
    // candidate cv (belum: sek error mbo nantian )
    // Route::get('/candidate-cv/{candidate}', [AdminController::class, 'candidateCV'])->name('admin.candidate.cv');
    Route::get('/candidate-cv/{candidate}', [AdminController::class, 'detail'])->name('admin.candidate.cv');
    // candidate hasil interview (belum)
    Route::get('/applicant-interview/{applicant}', [AdminController::class, 'interviewResult'])->name('admin.candidate.result');


});


// candidate page (belum ada middleware applicant)
Route::prefix('main')->middleware(['applicant'])->group(function () {
    //tahap 1:
    Route::get('application-form', [CandidateController::class, 'applicationForm'])->name('applicant.application-form');
    Route::post('store-application', [CandidateController::class, 'storeApplication'])->name('applicant.application.store');
    Route::patch('update-application', [CandidateController::class, 'updateApplication'])->name('applicant.application.update');

    // tahap 2:
    Route::get('documents-form', [CandidateController::class, 'documentsForm'])->name('applicant.documents-form');
    Route::post('store-document/{type}', [CandidateController::class, 'storeDocument'])->name('applicant.document.store')
        ->where(
            'type',
            strtolower(
                join('|', array_keys(CandidateController::documentTypes()))
            )
        );

    // // tahap 3:
    Route::get('schedule-form', [CandidateController::class, 'scheduleForm'])->name('applicant.schedule-form');
    Route::post('get-schedule', [CandidateController::class, 'getTimeSlot'])->name('applicant.get-schedule');
    Route::post('pick-schedule', [CandidateController::class, 'pickSchedule'])->name('applicant.pick-schedule');
    Route::post('reschedule', [CandidateController::class, 'reschedule'])->name('applicant.reschedule');

    // Route::get('interview-detail', [CandidateController::class, 'interviewDetail'])->name('applicant.interview-detail');
    // Route::get('cv', [CandidateController::class, 'previewCV'])->name('applicant.cv');

});

