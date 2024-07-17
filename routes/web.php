<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'home');
Route::view('/contact', 'contact');

//Route::get('/jobs', [JobController::class, 'index']);
//Route::get('/jobs/create', [JobController::class, 'create']);
//Route::get('/jobs/{job}', [JobController::class, 'show']);
//Route::post('/jobs', [JobController::class, 'store']);
//Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
//Route::patch('/jobs/{job}', [JobController::class, 'update']);
//Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// or

//Route::controller(JobController::class)->group(function () {
//    Route::get('/jobs', 'index');
//    Route::get('/jobs/create', 'create');
//    Route::get('/jobs/{job}', 'show');
//    Route::post('/jobs', 'store');
//    Route::get('/jobs/{job}/edit', 'edit');
//    Route::patch('/jobs/{job}', 'update');
//    Route::delete('/jobs/{job}', 'destroy');
//
//});

// or with resource

Route::resource('jobs', JobController::class);

// if you don't need all of actions
//Route::resource('jobs', JobController::class, [
// 'only' => ['index', 'show']
// or 'except' => ['edit', 'destroy']
//]);

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
