<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Job;
use App\Models\Skill;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    // Fetch jobs and load skills
    $jobs = Job::with('extra')->get()->map(function ($job) {
        // Decode the JSON string stored in the skills column
        $skillIds = json_decode($job->skills, true);

        // If skill IDs exist, fetch skill names from the Skill model
        if (is_array($skillIds)) {
            $skills = Skill::whereIn('id', $skillIds)->pluck('name')->toArray();
            $job->skills = $skills;
        } else {
            $job->skills = [];
        }

        return $job;
    });
    return Inertia::render('Dashboard', [
        'jobs' => $jobs,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
