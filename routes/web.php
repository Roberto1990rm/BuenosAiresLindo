<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarriosController;
use App\Http\Controllers\BaresController;
use App\Http\Controllers\ParqueController;
use App\Http\Controllers\OcioController;
use App\Models\Barrio;



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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/barrios/create', [BarriosController::class,'create'])->name('barrios.create');
Route::post('/barrios/create/store', [BarriosController::class,'store'])->name('barrios.store');
Route::get('/barrios/index', [BarriosController::class, 'index'])->name('barrios.index');
Route::get('/barrios/{barrio}', [BarriosController::class, 'show'])->name('barrios.show');
Route::delete('/barrios/{id}', [BarriosController::class, 'delete'])->name('barrios.delete');




Route::get('/bares/create', [BaresController::class, 'create'])->name('bares.create');
Route::post('/bares', [BaresController::class, 'store'])->name('bares.store');
Route::get('/bares', [BaresController::class, 'index'])->name('bares.index');
Route::get('/bares/{id}', [BaresController::class, 'show'])->name('bares.show');
Route::delete('/bares/{bar}',[BaresController::class, 'destroy'])->name('bares.destroy')->middleware('auth');



Route::get('/parques/create', [ParqueController::class, 'create'])->name('parques.create');
Route::post('/parques/store', [ParqueController::class, 'store'])->name('parques.store');
Route::get('/parques/index', [ParqueController::class, 'index'])->name('parques.index');
Route::get('/parques/{id}', [ParqueController::class, 'show'])->name('parque.show');
Route::delete('/parques/{id}',[ParqueController::class, 'destroy'])->name('parques.destroy');


Route::get('/ocio/create', [OcioController::class, 'create'])->name('ocio.create');
Route::post('/ocio', [OcioController::class, 'store'])->name('ocio.store');
Route::get('/ocio/index', [OcioController::class, 'index'])->name('ocio.index');
Route::delete('/ocio/{ocio}',[OcioController::class, 'destroy'])->name('ocio.destroy');

