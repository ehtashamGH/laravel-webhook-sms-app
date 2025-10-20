<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageTemplateController;
use App\Http\Controllers\SmsConfigController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('templates', MessageTemplateController::class);
    Route::get('/config', [SmsConfigController::class, 'edit'])->name('config.edit');
    Route::put('/config', [SmsConfigController::class, 'update'])->name('config.update');
});
