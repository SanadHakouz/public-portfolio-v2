<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\VisitorSessionsController;
use App\Http\Controllers\TwoFactorController;
use App\Models\Project;
use App\Models\LoginAttempt;
use App\Models\ProjectClick;

// Main website routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Projects routes
Route::get('/projects', function () {
    return view('pages.projects');
})->name('projects');

Route::get('/projects/{project}', function ($project) {
    $project = Project::findOrFail($project);

    // Record the project click
    ProjectClick::create([
        'project_id' => $project->id,
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'referrer' => request()->header('referer')
    ]);

    return view('pages.project-detail', compact('project'));
})->name('projects.show');

// About page
Route::get('/about', function () {
    return view('pages.about');
})->name('about-me');

// Contact routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact-me');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Two-Factor Authentication Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/two-factor-challenge', [TwoFactorController::class, 'index'])
        ->name('two-factor.challenge');

    Route::post('/two-factor-challenge', [TwoFactorController::class, 'verify'])
        ->name('two-factor.verify');

    Route::post('/two-factor-challenge/resend', [TwoFactorController::class, 'resend'])
        ->name('two-factor.resend');
});

// Admin authentication routes with 2FA
Route::get('/secret', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Admin routes protected by auth, admin, and two-factor middleware
Route::prefix('admintest')->name('admin.')->middleware(['auth', 'admin', 'two-factor'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Project management
    Route::get('/projects', function () {
        return view('admin.projects');
    })->name('projects');

    // Services Management
    Route::get('/services', function () {
        return view('admin.services');
    })->name('services');

    // Technologies Management
    Route::get('/technologies', function () {
        return view('admin.technologies');
    })->name('technologies');

    // About Me management
    Route::get('/about-me', function () {
        return view('admin.about-me');
    })->name('about-me');

    // Messages management
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{id}', [MessagesController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{id}', [MessagesController::class, 'destroy'])->name('messages.destroy');

    // Login Activity monitoring
    Route::get('/login-activity', function () {
        $attempts = LoginAttempt::orderBy('created_at', 'desc')
                              ->paginate(20);
        return view('admin.login-activity', compact('attempts'));
    })->name('login-activity');

    // Analytics Dashboard
    Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

    // Visitor Sessions routes
    Route::get('/visitor-sessions', [VisitorSessionsController::class, 'index'])->name('visitor-sessions');
    Route::get('/visitor-sessions/{id}', [VisitorSessionsController::class, 'show'])->name('visitor-sessions.show');
});

// Handle undefined routes with 404
Route::fallback(function () {
    abort(404);
});