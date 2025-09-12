<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth/login');
});




// Route::get('/dashboard', function () {
//     return redirect()->route('experiences.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('experience', [ExperienceDetailController::class, 'index'])->name('experience.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('experiences', ExperienceDetailController::class);
    Route::get('/experiences/{experiences}/pdffs', [ExperienceDetailController::class, 'generatePDFFS'])->name('experiences.pdffs');
    Route::get('/experiences/{experiences}/bast', [ExperienceDetailController::class, 'generateBAST'])->name('experiences.bast');
    Route::get('export', [ExperienceDetailController::class, 'export'])->name('experiences.export');
Route::post('/import', [ExperienceDetailController::class, 'import'])->name('experiences.import');

Route::get('/experiences/pdf/all', [ExperienceDetailController::class, 'generatePdfAll'])->name('experiences.pdfAll');
   

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
     Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
       Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
});

});



require __DIR__.'/auth.php';
