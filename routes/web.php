<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodosController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware(['auth'])->group(function () {
    // Todas las rutas dentro de este grupo requerirán que el usuario haya iniciado sesión

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/todos', [TodosController::class, 'index'])->name('todos');

    Route::post('/todos', [TodosController::class, 'store']);

    Route::delete('/todos/{id}', [TodosController::class, 'destroy'])->name('todos-destroy');

    Route::get('/todos/{id}', [TodosController::class, 'show'])->name('todos-edit');

    Route::patch('/todos/{id}', [TodosController::class, 'update'])->name('todos-update');

    Route::put('/todos/{id}', [TodosController::class, 'update'])->name('todos-update');

    // Categories
    Route::resource('categories', CategoryController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
