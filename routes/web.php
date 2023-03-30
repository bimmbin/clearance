<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\EditStudentController;
use App\Http\Controllers\student\ClearanceController;
use App\Http\Controllers\admin\CreateOfficerController;
use App\Http\Controllers\admin\CreateStudentController;
use App\Http\Controllers\admin\ViewClearanceController;
use App\Http\Controllers\admin\DeployClearanceController;
use App\Http\Controllers\admin\RegisterOfficerController;
use App\Http\Controllers\admin\RegisterStudentController;
use App\Http\Controllers\admin\CreateDepartmentController;
use App\Http\Controllers\officer\ClearanceActionController;
use App\Http\Controllers\officer\SearchClearanceController;
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
Route::post('/decryp', [HomeController::class, 'decryp'])->name('decryp');

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
    //student edit
    Route::post('/editstudent', [EditStudentController::class, 'store'])->name('edit.student');


    //officer create

    Route::get('/officer', [CreateOfficerController::class, 'index'])->name('admin.officerview');
    Route::post('/officercreate', [RegisterOfficerController::class, 'store'])->name('admin.createofficer');

    //department create
    Route::get('/createdepartment', [CreateDepartmentController::class, 'index'])->name('createdepartment');
    Route::post('/create/department', [CreateDepartmentController::class, 'store'])->name('store.department');

    //clearance create
    Route::get('/deployment', [ViewClearanceController::class, 'index'])->name('admin.deployment');
    Route::post('/create/clearance', [DeployClearanceController::class, 'store'])->name('store.clearance');
});



// student
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('/clearance', [ClearanceController::class, 'index'])->name('student.clearance');
});


// officer
Route::middleware(['auth', 'officer'])->group(function () {
    Route::get('/approved-clearance', [StudentClearanceController::class, 'approved'])->name('approved.view');
    Route::get('/disapproved-clearance', [StudentClearanceController::class, 'disapproved'])->name('disapproved.view');
    Route::get('/pending-clearance', [StudentClearanceController::class, 'pending'])->name('pending.view');

    Route::post('/clearance/approve', [ClearanceActionController::class, 'approve'])->name('approve.clearance');
    Route::post('/clearance/disapprove/{id}', [ClearanceActionController::class, 'disapprove'])->name('disapprove.clearance');

    //search
    Route::post('/search', [SearchClearanceController::class, 'store'])->name('search.clearance');
    Route::get('/clearance/search', [SearchClearanceController::class, 'index'])->name('search.result');
});
