<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\SkillController;
use App\Models\Experience;
use App\Models\Projet;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

// Page d'accueil publique (portfolio)
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// Formulaire de contact public
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'projetsCount' => Projet::count(),
        'skillsCount' => Skill::count(),
        'experiencesCount' => Experience::count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Administration du portfolio (protégée par auth)
    Route::resource('projets', ProjetController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show', 'create', 'edit']);
    Route::resource('experiences', ExperienceController::class)->except(['show', 'create', 'edit']);
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__.'/auth.php';