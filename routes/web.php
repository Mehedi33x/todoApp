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

Route::get('/admin-login',[AuthController::class,'login'])->name('auth.login');
Route::get('/register',[AuthController::class,'register'])->name('auth.register');
Route::post('/do-register',[AuthController::class,'doRegister'])->name('do.register');
Route::post('/do-login',[AuthController::class,'doLogin'])->name('do.login');
Route::get('/admin-logout',[AuthController::class,'logout'])->name('auth.logout');

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('task.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('task.delete');
