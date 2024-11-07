<?php

use App\Http\Controllers\TarefaController;
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


Route::get('/tarefas', [TarefaController::class, 'index'])->name('tarefas.index');
Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
Route::delete('/tarefas/{id}', [TarefaController::class, 'destroy'])->name('tarefas.delete');
Route::put('/tarefas/{id}', [TarefaController::class, 'update'])->name('tarefas.edit');
Route::get('/tarefas/{id}', [TarefaController::class, 'getById'])->name('tarefas.getById');
Route::post('/tarefas/reorder', [TarefaController::class, 'updateOrder']);
