<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExperienceDetailController;
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

Route::get('/', [ExperienceDetailController::class, 'index2'])->name('welcome');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('experiences', ExperienceDetailController::class);
<<<<<<< HEAD
    Route::get('/experiences/{experiences}/pdffs', [ExperienceDetailController::class, 'generatePDFFS'])->name('experiences.pdffs');
=======
    //Route::get('/experiences/{experiences}/pdffs', [ProjectController::class, 'generatePDFFS'])->name('experiences.pdffs');
>>>>>>> 0a1f0ce1e12141d40c8981e43718fb22b00dc49e



});

require __DIR__.'/auth.php';
