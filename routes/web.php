<?php

use App\Http\Controllers\Backend\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/do-login',[AuthController::class,'doLogin'])->name('do.login');

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('task.delete');
