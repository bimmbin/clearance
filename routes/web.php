<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ClearanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/register', [RegisterController::class, 'index'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/reg', [RegisterController::class, 'registerStudent'])->name('registerStudent');


Route::get('/storeStudent', [ProfilesController::class, 'storeStudent'])->name('storeStudent');
Route::post('/previewTable', [RegisterController::class, 'previewTable'])->name('previewTable');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


// admin
Route::get('/createstudent', [AdminController::class, 'index'])->name('createstudent');
Route::get('/createofficer', [AdminController::class, 'createOfficer'])->name('createOfficer');


Route::get('/createdepartment', [DepartmentController::class, 'index'])->name('createdepartment');
Route::post('/create/department', [DepartmentController::class, 'store'])->name('store.department');

Route::get('/create/clearance', [ClearanceController::class, 'store'])->name('store.clearance');

Route::post('/registerOfficer', [RegisterController::class, 'registerOfficer'])->name('registerOfficer');
Route::get('/storeOfficer', [ProfilesController::class, 'storeOfficer'])->name('storeOfficer');