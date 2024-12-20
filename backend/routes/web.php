<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');

Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');


Route::middleware('admin')->group(function() {
    // prefix se utiliza para PREFIJAR cada ruta en el grupo con una URI dada
    Route::prefix('admin')->group(function(){
        
        // Ruta del dashboard protegida por middleware
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
        
        // Ruta de logout protegida por middleware
        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');
    
        // Rutas "Colores"
        Route::resource('colors', ColorController::class, 
        // Personalizar el nombre de las rutas
        [
            'names' => [
                'index' => 'admin.colors.index',
                'create' => 'admin.colors.create',
                'store' => 'admin.colors.store',
                'edit' => 'admin.colors.edit',
                'update' => 'admin.colors.update',
                'destroy' => 'admin.colors.destroy',
            ]
        ]);
        
        // Rutas "Tamaños"
        Route::resource('sizes', SizeController::class, 
        // Personalizar el nombre de las rutas
        [
            'names' => [
                'index' => 'admin.sizes.index',
                'create' => 'admin.sizes.create',
                'store' => 'admin.sizes.store',
                'edit' => 'admin.sizes.edit',
                'update' => 'admin.sizes.update',
                'destroy' => 'admin.sizes.destroy',
            ]
        ]);
        
        // Rutas "Cupones"
        Route::resource('coupons', CouponController::class, 
        // Personalizar el nombre de las rutas
        [
            'names' => [
                'index' => 'admin.coupons.index',
                'create' => 'admin.coupons.create',
                'store' => 'admin.coupons.store',
                'edit' => 'admin.coupons.edit',
                'update' => 'admin.coupons.update',
                'destroy' => 'admin.coupons.destroy',
            ]
        ]);
       
        // Rutas "Productos"
        Route::resource('products', ProductController::class, 
        // Personalizar el nombre de las rutas
        [
            'names' => [
                'index' => 'admin.products.index',
                'create' => 'admin.products.create',
                'store' => 'admin.products.store',
                'edit' => 'admin.products.edit',
                'update' => 'admin.products.update',
                'destroy' => 'admin.products.destroy',
            ]
        ]);
    });
});