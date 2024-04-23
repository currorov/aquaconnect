<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\IndexController;


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

Route::get('/', [IndexController::class, "uploadIndex"])->name('index');
Route::post('/', [IndexController::class, "uploadIndex"])->name('index');


//main routes
Route::get('/create-event', [EventsController::class, "createEvent"])->name('createEvent');
Route::get('/login', [IndexController::class, "activeLogin"])->name('active_login');
Route::get('/register', [IndexController::class, "activeRegister"])->name('active_register');
Route::post('/checklogin', [IndexController::class, "checkLogin"])->name('checkLogin');
Route::post('/checkregister', [IndexController::class, "checkRegister"])->name('checkRegister');

//event routes
Route::post('/save-event', [EventsController::class, "submitCreateEvent"])->name('submitCreateEvent');
