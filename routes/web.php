<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SpecialtyController;

Route::resource('user_registers', UserRegisterController::class);
Route::resource('careers', CareerController::class);
Route::resource('specialties', SpecialtyController::class);

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
    return view('home');
});

Route::get('/register', [UserRegisterController::class, 'create'])->name('user-register');
Route::get('/check/{lineToken}', [UserRegisterController::class, 'checkLineToken'])->name('user-checkLineToken');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/dashboard/users', [UserRegisterController::class, 'index'])->name('users-all');
    Route::get('/dashboard/user/pending', [UserRegisterController::class, 'pending'])->name('users-pending');
    Route::get('/dashboard/user/approval', [UserRegisterController::class, 'approval'])->name('users-approval');
    Route::get('/dashboard/user/disapproval', [UserRegisterController::class, 'disapproval'])->name('users-disapproval');
    
    Route::get('/dashboard/specialties', [SpecialtyController::class, 'index'])->name('specialties-all');
    Route::get('/dashboard/specialty/{id}', [SpecialtyController::class, 'show'])->name('specialties-show');
    Route::get('/dashboard/specialties/add', [SpecialtyController::class, 'create'])->name('specialties-create');
    Route::get('/dashboard/specialty/edit/{id}', [SpecialtyController::class, 'edit'])->name('specialties-edit');

    Route::get('/dashboard/careers', [CareerController::class, 'index'])->name('careers-all');
    Route::get('/dashboard/career/{id}', [CareerController::class, 'show'])->name('careers-show');
    Route::get('/dashboard/careers/add', [CareerController::class, 'create'])->name('careers-create');

    Route::post('/user_registers/{id}/handle-approval', [UserRegisterController::class, 'handleApproval'])
    ->name('user_registers.handleApproval');
    Route::post('/user_registers/{id}/handle-disapproval', [UserRegisterController::class, 'handleDisapproval'])
    ->name('user_registers.handleDisapproval');

    // Route::get('/dashboard/careers', function () {
    //     return view('dashboard.careers.index');
    // })->name('career-all');
    // Route::get('/dashboard/career/add', function () {
    //     return view('dashboard.careers.create');
    // })->name('career-create');
});
