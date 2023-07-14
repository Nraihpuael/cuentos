<?php

use App\Http\Controllers\CuentoController;
use App\Http\Controllers\ElementoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaginaController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


Route::resource('cuento', CuentoController::class)->middleware('auth');

Route::get('cuento/{id}/descargar', [CuentoController::class, 'descargar'])->name('cuento.descargar');



Route::get('pagina/{id}', [PaginaController::class, 'index'])->name('pagina.index');
Route::get('pagina/{id}/create', [PaginaController::class, 'create'])->name('pagina.create');

Route::get('pagina/{id}/generar/{prompt}', [PaginaController::class, 'generar'])->name('pagina.generar');
Route::post('pagina/{id}/store', [PaginaController::class, 'store'])->name('pagina.store');
Route::get('pagina/{id}/{cuento_id}/show', [PaginaController::class, 'show'])->name('pagina.show');
Route::get('pagina/{id}/{cuento_id}/edit', [PaginaController::class, 'edit'])->name('pagina.edit');
Route::patch('/pagina/{id}/{cuento_id}/update',  [PaginaController::class, 'update'])->name('pagina.update');
Route::delete('pagina/{id}/{cuento_id}/destroy', [PaginaController::class, 'destroy'])->name('pagina.destroy');


Route::get('elemento/{id}', [ElementoController::class, 'index'])->name('elemento.index');
Route::get('elemento/{id}/create', [ElementoController::class, 'create'])->name('elemento.create');

Route::get('elemento/{id}/generar/{prompt}', [ElementoController::class, 'generar'])->name('elemento.generar');
Route::post('elemento/{id}/store', [ElementoController::class, 'store'])->name('elemento.store');
Route::get('elemento/{id}/{cuento_id}/show', [ElementoController::class, 'show'])->name('elemento.show');
Route::get('elemento/{id}/{cuento_id}/edit', [ElementoController::class, 'edit'])->name('elemento.edit');
Route::patch('/elemento/{id}/{cuento_id}/update',  [ElementoController::class, 'update'])->name('elemento.update');
Route::delete('elemento/{id}/{cuento_id}/destroy', [ElementoController::class, 'destroy'])->name('elemento.destroy');



