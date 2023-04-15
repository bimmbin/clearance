<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\registrar\ReportController;
use App\Http\Controllers\admin\CurrentViewController;
use App\Http\Controllers\admin\EditStudentController;
use App\Http\Controllers\student\ClearanceController;
use App\Http\Controllers\admin\CreateOfficerController;
use App\Http\Controllers\admin\CreateStudentController;
use App\Http\Controllers\admin\SearchStudentController;
use App\Http\Controllers\admin\ViewClearanceController;
use App\Http\Controllers\admin\CreateRegistrarController;
use App\Http\Controllers\admin\DeployClearanceController;
use App\Http\Controllers\admin\RegisterOfficerController;
use App\Http\Controllers\admin\RegisterStudentController;
use App\Http\Controllers\admin\CreateDepartmentController;
use App\Http\Controllers\officer\ClearanceActionController;
use App\Http\Controllers\officer\SearchClearanceController;
use App\Http\Controllers\officer\StudentClearanceController;
use App\Http\Controllers\registrar\RegistrarSearchController;
use App\Http\Controllers\registrar\RegistrarClearanceController;

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



Route::middleware(['guest'])->group(function () {

Route::get('/', [LoginController::class, 'index'])->name('home');
//reg
// Route::get('/register', [RegisterController::class, 'index'])->name('register');
// Route::post('/register', [RegisterController::class, 'store']);

//log-in
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

});
//log-out
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// admin
Route::middleware(['auth', 'admin'])->group(function () {

    //student create
    Route::get('/createstudent', [CreateStudentController::class, 'index'])->name('createstudent');
    Route::post('/previewTable', [RegisterStudentController::class, 'previewTable'])->name('previewTable');
    Route::post('/reg', [RegisterStudentController::class, 'registerStudent'])->name('registerStudent');
    Route::post('/createsingle', [RegisterStudentController::class, 'single'])->name('admin.createsingle');

    //student edit
    Route::post('/editstudent', [EditStudentController::class, 'store'])->name('edit.student');

    //student search
    Route::post('/searchstudent', [SearchStudentController::class, 'store'])->name('search.student');
    Route::get('/search-student', [SearchStudentController::class, 'index'])->name('search.studentresult');


    //officer create

    Route::get('/officer', [CreateOfficerController::class, 'index'])->name('admin.officerview');
    Route::post('/officercreate', [RegisterOfficerController::class, 'store'])->name('admin.createofficer');

    //department create
    Route::get('/createdepartment', [CreateDepartmentController::class, 'index'])->name('createdepartment');
    Route::post('/create/department', [CreateDepartmentController::class, 'store'])->name('store.department');

    //registrar create
    Route::get('/registrar', [CreateRegistrarController::class, 'index'])->name('admin.createregistrar');
    Route::post('/registrar-create', [CreateRegistrarController::class, 'store'])->name('admin.registerregistrar');

    //clearance create
    Route::get('/deployment', [ViewClearanceController::class, 'index'])->name('admin.deployment');
    Route::post('/create/clearance', [DeployClearanceController::class, 'store'])->name('store.clearance');

    //current view
    Route::get('/currentview', [CurrentViewController::class, 'index'])->name('admin.currentview');
    Route::post('/currentview-update', [CurrentViewController::class, 'store'])->name('admin.updateview');
    //add year
    Route::post('/add-year', [CurrentViewController::class, 'addyear'])->name('admin.addyear');


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
    Route::post('/clearance/disapprove', [ClearanceActionController::class, 'disapprove'])->name('disapprove.clearance');

    //search
    Route::post('/search', [SearchClearanceController::class, 'store'])->name('search.clearance');
    Route::get('/clearance/search', [SearchClearanceController::class, 'index'])->name('search.result');
});

// Registrar
Route::middleware(['auth', 'registrar'])->group(function () {
   
    Route::get('/registrar-clearance', [RegistrarClearanceController::class, 'index'])->name('registrar.clearance');
    
    Route::get('/registrar-reports', [ReportController::class, 'index'])->name('registrar.reports');
    
    // Route::get('/registrar-reports', \App\Http\Livewire\ReportList::class)->name('registrar.reports');

    Route::post('/search-clearance', [RegistrarSearchController::class, 'store'])->name('registrar.search');

});



