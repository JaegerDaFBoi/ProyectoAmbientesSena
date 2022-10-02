<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LearningOutcomeController;
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

//Rutas Fichas
Route::get('/fichas/index', [CardController::class, 'index'])->name('fichas.index');
Route::get('/fichas/create', [CardController::class, 'create'])->name('fichas.create');
Route::post('/fichas/store', [CardController::class, 'store'])->name('fichas.store');
Route::get('/fichas/{ficha}/edit', [CardController::class, 'edit'])->name('fichas.edit');

//Rutas Competencias
Route::get('/competencias/{idprograma}/index', [CompetenceController::class, 'index'])->name('competencias.index');

//Rutas Resultados
Route::get('/resultados/{idcompetencia}/create', [LearningOutcomeController::class, 'create'])->name('resultados.create');
Route::post('/resultados/{competencia}/{programa}/store', [LearningOutcomeController::class, 'store'])->name('resultados.store');

//Rutas Calendario
Route::get('/eventos/index', [EventController::class, 'index'])->name('eventos.index');
Route::post('/eventos/store', [EventController::class, 'store'])->name('eventos.store');
Route::get('(eventos/mostrar', [EventController::class, 'show']);