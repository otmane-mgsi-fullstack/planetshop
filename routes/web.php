<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashIndexController;
use App\Http\Controllers\DashProductController;
use App\Http\Controllers\DashCategoryController;
use App\Http\Controllers\DashClientController;
use App\Http\Controllers\DashOrderController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\DashSupportController;
// Page d'un produit (accessible à tous)
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (login/register)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| STORE (public)
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'index'])
    ->name('store.index');

Route::get('/produit/{slug}', [ProductPageController::class, 'show'])->name('product.show');


Route::post('/commander/{id}', [\App\Http\Controllers\ProductPageController::class, 'commander'])
    ->name('commander.directement')
    ->middleware('auth');


// web.php
//Route::get('/product/{slug}', [ProductPageController::class, 'show'])->name('product.show');
/*
|--------------------------------------------------------------------------
| LOGOUT (must be authenticated)
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('dash')
    ->group(function () {

        // Dashboard home
        Route::get('/index', [DashIndexController::class, 'index'])
            ->name('dash.index');

        /*
        | PRODUCTS
        */
        Route::get('/products', [DashProductController::class, 'index'])
            ->name('dash.product');

        Route::post('/products', [DashProductController::class, 'store'])->name('products.store');
        Route::put('/products/{product}', [DashProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [DashProductController::class, 'destroy'])->name('products.destroy');

        /*
        | CATEGORIES
        */
        Route::get('/categories', [DashCategoryController::class, 'index'])
            ->name('dash.category');

        Route::post('/categories', [DashCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [DashCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [DashCategoryController::class, 'destroy'])->name('categories.destroy');

        /*
        | CLIENTS
        */
        Route::get('/clients', [DashClientController::class, 'index'])
            ->name('dash.client');

        Route::post('/clients', [DashClientController::class, 'store'])
            ->name('clients.store');
        Route::put('/clients/{client}', [DashClientController::class, 'update'])
            ->name('clients.update');
        Route::post('/clients/{client}/toggle-status', [DashClientController::class, 'toggleStatus'])
            ->name('clients.toggle.status');
        Route::delete('/clients/{client}', [DashClientController::class, 'destroy'])
            ->name('clients.destroy');
        Route::post('/clients/{client}/toggle', [App\Http\Controllers\DashClientController::class, 'toggleStatus'])
            ->name('clients.toggle');
        /*
        | ORDERS
        */
        Route::get('/orders', [DashOrderController::class, 'index'])
            ->name('dash.order');

        Route::put('/orders/{order}', [DashOrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [DashOrderController::class, 'destroy'])->name('orders.destroy');



        //Route::prefix('admin/support')->name('admin.support.')->group(function () {
            Route::get('/', [DashSupportController::class, 'index'])->name('dash.support');
            Route::post('/{id}/update-status', [DashSupportController::class, 'updateStatus'])->name('updateStatus');
            Route::delete('/{id}', [DashSupportController::class, 'destroy'])->name('destroy');
       // });
    });
