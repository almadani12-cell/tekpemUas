<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PerformaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizLevelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Materi Routes
    Route::prefix('materi')->name('materi.')->group(function () {
        Route::get('/', [MateriController::class, 'index'])->name('index');
        Route::get('/cptp', [MateriController::class, 'cptp'])->name('cptp');
        Route::get('/{pillar}/{type}', [MateriController::class, 'show'])->name('show')
            ->where('type', 'text|video');
    });

    // Evaluasi Routes
    Route::prefix('evaluasi')->name('evaluasi.')->group(function () {
        Route::get('/', [EvaluasiController::class, 'index'])->name('index');
        
        // Level-based Quiz Routes (NEW SYSTEM)
        Route::get('/{pillar}/levels', [QuizLevelController::class, 'selectLevel'])->name('levels');
        Route::get('/{pillar}/level/{level}/start', [QuizLevelController::class, 'startLevel'])->name('start-level');
        Route::get('/{pillar}/level/{level}/quiz/{attempt}', [QuizLevelController::class, 'showQuiz'])->name('quiz-level');
        Route::post('/{pillar}/level/{level}/quiz/{attempt}/answer', [QuizLevelController::class, 'submitAnswer'])->name('submit-answer');
        Route::get('/{pillar}/level/{level}/results/{attempt}', [QuizLevelController::class, 'results'])->name('results');
        
        // Old system routes (kept for backward compatibility)
        Route::get('/{pillar}/start', [EvaluasiController::class, 'startQuiz'])->name('start');
        Route::get('/{pillar}/quiz/{attempt}', [EvaluasiController::class, 'quiz'])->name('quiz');
        Route::post('/{pillar}/quiz/{attempt}/answer', [EvaluasiController::class, 'submitAnswer'])->name('answer');
        Route::get('/{pillar}/review/{attempt}', [EvaluasiController::class, 'review'])->name('review');
    });

    // Performa Routes
    Route::get('/performa', [PerformaController::class, 'index'])->name('performa.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Static Pages
    Route::get('/tim-pengembang', [PageController::class, 'timPengembang'])->name('pages.tim-pengembang');
    Route::get('/sumber', [PageController::class, 'sumber'])->name('pages.sumber');
});

require __DIR__.'/auth.php';
