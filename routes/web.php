<?php

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
    return view('index');
})->name('home');

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/registry', function () {
        return view('user.registry');
    })->name('registry')->middleware('guest');

    Route::post('/create', [
        \App\Http\Controllers\UserController::class, 'create'
    ])->name('create')->middleware('guest');

    Route::get('/login', function () {
        return view('user.login');
    })->name('login')->middleware('guest');

    Route::post('/auth', [
        \App\Http\Controllers\UserController::class, 'auth'
    ])->name('auth')->middleware('guest');

    Route::get('/logout', [
        \App\Http\Controllers\UserController::class, 'logout'
    ])->name('logout')->middleware('auth');
});

Route::prefix('task')->name('task.')->group(function () {
    Route::get('/', [
        \App\Http\Controllers\TaskController::class, 'main'
    ])->name('main')->middleware('auth');

    Route::any('/{id}/delete', [
        \App\Http\Controllers\TaskController::class, 'delete'
    ])->name('delete');

    Route::get('/get/{id}', [
        \App\Http\Controllers\TaskController::class, 'get'
    ])->name('get')->middleware('auth');

    Route::post('/update', [
        \App\Http\Controllers\TaskController::class, 'update'
    ])->name('update')->middleware('auth');

    Route::get('/all', [
        \App\Http\Controllers\TaskController::class, 'all'
    ])->name('all')->middleware('auth');

    Route::get('/create', [
        \App\Http\Controllers\TaskController::class, 'create'
    ])->name('create')->middleware('auth');

    Route::post('/save', [
        \App\Http\Controllers\TaskController::class, 'save'
    ])->name('save')->middleware('auth');
});
