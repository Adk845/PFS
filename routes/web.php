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

Route::get('/', [ExperienceDetailController::class, 'guest'])->name('guest');



Route::get('/dashboard', function () {
    return redirect()->route('experiences.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('experiences', ExperienceDetailController::class);
    Route::get('/experiences/{experiences}/pdffs', [ExperienceDetailController::class, 'generatePDFFS'])->name('experiences.pdffs');
Route::get('/experiences/pdf/all', [ExperienceDetailController::class, 'generatePdfAll'])->name('experiences.pdfAll');
   
});



require __DIR__.'/auth.php';
