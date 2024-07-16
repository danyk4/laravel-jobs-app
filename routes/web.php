<?php

use App\Models\Job;
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

Route::get('/', function () {
    return view('home');
});

// All Jobs - index action
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(10);

    return view(' jobs.index', [
      'jobs' => $jobs
    ]);
});

// Create Job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Show a Job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    return view('jobs.show', ['job' => $job]);
});

// Store a new Job
Route::post('/jobs', function () {
    request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required'],
    ]);

    Job::create([
      'title' => request('title'),
      'salary' => request('salary'),
      'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit Job
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);

    return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()->validate([
      'title' => ['required', 'min:3'],
      'salary' => ['required'],
    ]);

    // authorize


    // update the job
    $job = Job::findOrFail($id);


    $job->update([
      'title' => request('title'),
      'salary' => request('salary'),
    ]);

    // and persist

    // redirect to the job page
    return redirect('/jobs/'.$job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {
    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
