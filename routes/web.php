<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventUserRegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;

Route::resource('user_registers', UserRegisterController::class);
Route::resource('careers', CareerController::class);
Route::resource('specialties', SpecialtyController::class);
Route::resource('events', EventController::class);
Route::resource('event_user_registers', EventUserRegisterController::class);
Route::resource('contacts', ContactController::class);
Route::resource('dashboard', DashboardController::class);

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

Route::get('/coming', function () {
    return view('home');
});

Route::get('/register', [UserRegisterController::class, 'create'])->name('user-register');
Route::get('/check/{lineToken}', [UserRegisterController::class, 'checkLineToken'])->name('user-checkLineToken');
Route::get('/check-registration', [UserRegisterController::class, 'checkRegistration'])->name('user-checkRegistration');
Route::get('/check-event', [EventUserRegisterController::class, 'checkEvent'])->name('user-checkEvent');
Route::get('/event/all', [EventController::class, 'calendar'])->name('event-calendar');
Route::get('/contact', [ContactController::class, 'create'])->name('contact-create');
Route::get('/get-user-data', [ContactController::class, 'getUserDataToken'])->name('get-user-data-token');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/users', [UserRegisterController::class, 'index'])->name('users-all');
    Route::get('/users/pending', [UserRegisterController::class, 'pending'])->name('users-pending');
    Route::get('/users/approval', [UserRegisterController::class, 'approval'])->name('users-approval');
    Route::get('/users/disapproval', [UserRegisterController::class, 'disapproval'])->name('users-disapproval');
    Route::get('/user/{id}', [UserRegisterController::class, 'show'])->name('user-show');
    Route::get('/user/edit/{id}', [UserRegisterController::class, 'edit'])->name('user-edit');
    
    Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties-all');
    Route::get('/specialty/{id}', [SpecialtyController::class, 'show'])->name('specialties-show');
    Route::get('/specialties/add', [SpecialtyController::class, 'create'])->name('specialties-create');
    Route::get('/specialty/edit/{id}', [SpecialtyController::class, 'edit'])->name('specialties-edit');

    Route::get('/careers', [CareerController::class, 'index'])->name('careers-all');
    Route::get('/career/{id}', [CareerController::class, 'show'])->name('careers-show');
    Route::get('/careers/add', [CareerController::class, 'create'])->name('careers-create');

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

    Route::get('/events', [EventController::class, 'index'])->name('events-all');
    Route::get('/event/add', [EventController::class, 'create'])->name('event-create');
    Route::get('/event/{id}', [EventController::class, 'show'])->name('event-show');

    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts-all');
    Route::post('/contacts/{id}/readed', [ContactController::class, 'changeAlreadyRead'])
    ->name('contacts.changeAlreadyRead');
});
