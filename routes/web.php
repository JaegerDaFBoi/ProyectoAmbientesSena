<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LearningOutcomeController;
use App\Http\Controllers\ProgramController;
use App\Models\Instructor;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //Rutas Instructores
    Route::prefix('instructores')->group(function () {
        Route::name('instructores.')->group(function () {
            Route::controller(InstructorController::class)->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{instructor}/edit', 'edit')->name('edit');
                Route::get('/{instructor}/horarios', 'show')->name('horarios');
                Route::get('/{eventid}/evento', 'searchEvent')->name('evento');
            });
        });
    });
    //Rutas Ambientes
    Route::prefix('ambientes')->group(function () {
        Route::name('ambientes.')->group(function () {
            Route::controller(EnvironmentController::class)->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/{ambiente}/horarios', 'show')->name('horarios');
            });
        });
    });
    //Rutas Programas
    Route::prefix('programas')->group(function () {
        Route::name('programas.')->group(function () {
            Route::controller(ProgramController::class)->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::get('/{programa}/edit', 'edit')->name('edit');
            });
        });
    });
    //Rutas Fichas
    Route::prefix('fichas')->group(function () {
        Route::name('fichas.')->group(function () {
            Route::controller(CardController::class)->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{ficha}/edit', 'edit')->name('edit');
                Route::get('/{ficha}/horarios')->name('horarios');
            });
        });
    });
    //Rutas Competencias
    Route::get('/competencias/{idprograma}/index', [CompetenceController::class, 'index'])->name('competencias.index');
    //Rutas Resultados
    Route::prefix('resultados')->group(function () {
        Route::name('resultados.')->group(function () {
            Route::controller(LearningOutcomeController::class)->group(function () {
                Route::get('/{idcompetencia}/create', 'create')->name('create');
                Route::post('/{competencia}/{programa}/store', 'store')->name('store');
            });
        });
    });
    //Rutas Calendario
    Route::prefix('eventos')->group(function () {
        Route::name('eventos.')->group(function () {
            Route::controller(EventController::class)->group(function () {
                Route::get('/index', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::get('/mostrar', 'show')->name('show');
            });
        });
    });
});




