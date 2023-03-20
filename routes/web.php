<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\student\ClearanceController;
use App\Http\Controllers\admin\CreateOfficerController;
use App\Http\Controllers\admin\CreateStudentController;
use App\Http\Controllers\admin\RegisterOfficerController;
use App\Http\Controllers\admin\RegisterStudentController;
use App\Http\Controllers\admin\CreateDepartmentController;
use App\Http\Controllers\officer\ClearanceActionController;
use App\Http\Controllers\officer\StudentClearanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/homes', [HomeController::class, 'store'])->name('homes');

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);





Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


// admin
Route::middleware(['auth', 'admin'])->group(function () {

    //student create
    Route::get('/createstudent', [CreateStudentController::class, 'index'])->name('createstudent');
    Route::post('/previewTable', [RegisterStudentController::class, 'previewTable'])->name('previewTable');
    Route::post('/reg', [RegisterStudentController::class, 'registerStudent'])->name('registerStudent');

    //officer create

    Route::get('/officer', [CreateOfficerController::class, 'index'])->name('admin.officerview');
    Route::post('/officercreate', [RegisterOfficerController::class, 'store'])->name('admin.createofficer');

    //department create
    Route::get('/createdepartment', [CreateDepartmentController::class, 'index'])->name('createdepartment');
    Route::post('/create/department', [CreateDepartmentController::class, 'store'])->name('store.department');

    //clearance create
    Route::get('/create/clearance', [ClearanceController::class, 'store'])->name('store.clearance');
});



// student
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/clearance', [ClearanceController::class, 'index'])->name('student.clearance');
});


// officer
Route::middleware(['auth', 'officer'])->group(function () {
    Route::get('/approved-clearance', [StudentClearanceController::class, 'approved'])->name('approved.clearance');
    Route::get('/disapproved-clearance', [StudentClearanceController::class, 'disapproved'])->name('disapproved.clearance');
    Route::get('/pending-clearance', [StudentClearanceController::class, 'pending'])->name('pending.clearance');

    Route::post('/clearance/approve/{id}', [ClearanceActionController::class, 'approve'])->name('approve.clearance');
    Route::post('/clearance/disapprove/{id}', [ClearanceActionController::class, 'disapprove'])->name('disapprove.clearance');
});
