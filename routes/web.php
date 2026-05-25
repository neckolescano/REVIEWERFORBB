<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

// Standard routes for local development
Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/submit', [QuizController::class, 'submit'])->name('quiz.submit');

// Vercel compatibility routes
Route::get('/api', [QuizController::class, 'index']);
Route::post('/api/submit', [QuizController::class, 'submit']);