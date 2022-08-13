<?php

use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('principal.index');
    })->name('dashboard');
});

//Rutas Instructores
Route::get('/instructores/index', [InstructorController::class, 'index'])->name('instructores.index');
Route::get('/instructores/create', [InstructorController::class, 'create'])->name('instructores.create');
Route::get('/instructores/{instructor}/edit', [InstructorController::class, 'edit'])->name('instructores.edit');

//Rutas Ambientes
Route::get('/ambientes/index', [EnvironmentController::class, 'index'])->name('ambientes.index');

//Rutas Programas
Route::get('/programas/index', [ProgramController::class, 'index'])->name('programas.index');
Route::get('/programas/create', [ProgramController::class, 'create'])->name('programas.create');
Route::get('/programas/{programa}/edit', [ProgramController::class, 'edit'])->name('programas.edit');