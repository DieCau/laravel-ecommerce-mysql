<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');

Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');


Route::middleware('admin')->group(function() {
    // Ruta del dashboard protegida por middleware
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    
    // Ruta de logout protegida por middleware
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});