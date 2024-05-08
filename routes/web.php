<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JetskyController;


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
Route::get('/add-jetsky', [JetskyController::class, "addJetsky"])->name('addJetsky');
Route::get('/login', [IndexController::class, "activeLogin"])->name('active_login');
Route::get('/logout', [IndexController::class, "logout"])->name('logout');
Route::get('/register', [IndexController::class, "activeRegister"])->name('active_register');
Route::post('/checklogin', [IndexController::class, "checkLogin"])->name('checkLogin');
Route::post('/checkregister', [IndexController::class, "checkRegister"])->name('checkRegister');
Route::get('/event/{eventId}/user/{userId}', [IndexController::class, "apuntaseAlEvento"])->name('apuntarseAlEvento');
Route::get('/event/{eventId}/user/{userId}/delete', [IndexController::class, "borrarDelEvento"])->name('borrarDelEvento');
Route::get('/recoverPassword', [IndexController::class, "recoverPassword"])->name('recoverPassword');
Route::post('/checkRecover', [IndexController::class, "checkRecover"])->name('checkRecover');

//event routes
Route::post('/save-event', [EventsController::class, "submitCreateEvent"])->name('submitCreateEvent');
Route::get('/miseventos/{userId}', [EventsController::class, "misEventos"])->name('miseventos');
Route::get('/eventosapuntado/{userId}', [EventsController::class, "eventosapuntado"])->name('eventosapuntado');

//jetsky routes
Route::post('/new-event', [JetskyController::class, "submitAddJetsky"])->name('submitAddJetsky');
Route::get('/delete-jetsky/{id}', [JetskyController::class, "deleteJetsky"])->name('deleteJetsky');
Route::get('/info-jetsky/{id}', [JetskyController::class, "infoJetsky"])->name('infoJetsky');


