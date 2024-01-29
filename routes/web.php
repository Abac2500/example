<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'page.index', ['title' => 'Описание задачи'])->name('index');

Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::view('/registry', 'page.user.registry', ['title' => 'Регистрация'])->name('registry');
        Route::post('/create', 'create')->name('create');
        Route::view('/login', 'page.user.login', ['title' => 'Авторизация'])->name('login');
        Route::post('/auth', 'auth')->name('auth');
    });

    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::controller(TaskController::class)->middleware('auth')->prefix('task')->name('task.')->group(function () {
    Route::get('/list/{view}', 'index')->name('index')->whereIn('view', ['all', 'user']);
    Route::get('/manage/{task?}', 'manage')->name('manage');
    Route::post('/save/{task?}', 'save')->name('save');
    Route::get('/delete/{task}', 'delete')->name('delete')->middleware('can:delete,task');
});
