<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/generate', [PromptController::class, 'index'])->name('generate.index');
    Route::post('/generate', [PromptController::class, 'generate'])->name('generate.run');

    Route::resource('templates', TemplateController::class)->except(['show']);
    Route::get('/templates/{template}/download/{format}', [TemplateController::class, 'download'])->name('templates.download');

    Route::resource('templates', TemplateController::class)->except(['show']);
});

require __DIR__.'/auth.php';
