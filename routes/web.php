<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->group(function () {
        Route::get('/', [HomeController::class, 'profile'])->name('profile');
        Route::patch('/update', [HomeController::class, 'update'])->name('update-profile');
    });

    Route::resource('students', StudentController::class)->middleware('can:manage students');

    Route::post('programs/{program}/apply', [ProgramController::class, 'apply'])
        ->name('program-apply')
        ->middleware('can:apply to programs');
});
