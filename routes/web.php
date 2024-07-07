<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\ScheduleController;
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
    echo "Home Page";
})->name('home');

// Auth
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::get('/loginRedirect', [AuthController::class , 'loginRedirect'])->name('google.redirect');
Route::get('/loginProcess', [AuthController::class , 'loginProcess'])->name('google.callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login/{nrp}/secret/{secret}', [AuthController::class, 'loginPaksa'])->name('loginPaksa');

// admin page
Route::prefix('admin')->middleware(['session','admin'])->group(function () {
    Route::get('/dashboard', function () {
        $data['title'] = "Dashboard";
        return view('admin.dashboard',$data);
    })->name('admin.dashboard');

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
        Route::get('/reschedule', [ScheduleController::class, 'myReschedule'])->name('admin.interview.my-reschedule');
        Route::post('/reschedule', [ScheduleController::class, 'reschedule'])->name('admin.interview.reschedule');
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


    // detail candidate (belum)
    Route::get('/detail/{candidate}', [AdminController::class, 'detail'])->name('admin.candidate.detail');
    // candidate cv (belum)
    Route::get('/applicant-cv/{applicant}', [AdminController::class, 'candidateCV'])->name('admin.candidate.cv');
    // candidate hasil interview (belum)
    Route::get('/applicant-interview/{applicant}', [AdminController::class, 'interviewResult'])->name('admin.candidate.result');


});


// candidate page (belum ada middleware applicant)
Route::prefix('main')->name('main.')->middleware([])->group(function () {
    Route::get('/application-form', function () {
        echo "application-form";
    })->name('application-form');

    Route::get('/interview', function () {
        echo('interview');
    })->name('interview');
});