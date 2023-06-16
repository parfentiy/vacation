<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacationController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/show_vacations', [VacationController::class, 'showVacations'])->name('show_vacations');
    Route::post('/plan_vacation', [VacationController::class, 'saveVacation'])->name('plan_vacation');
    Route::post('/update_vacation', [VacationController::class, 'updateVacation'])->name('update_vacation');
    Route::post('/delete_vacation', [VacationController::class, 'deleteVacation'])->name('delete_vacation');

});

require __DIR__.'/auth.php';
