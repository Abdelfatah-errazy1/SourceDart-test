<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\ProductController;

Route::name('products.')->controller(ProductController::class)->group(function(){
    Route::get('/products',  'index')->name('index');
    Route::get('/products/create',  'create')->name('create');
    Route::post('/products',  'store')->name('store');
    Route::get('/products/{product}',  'edit')->name('edit');
    Route::put('/products/{product}',  'update')->name('update');
});

Route::name('categories.')->controller(CategoryController::class)->group(function(){
    Route::get('/categories',  'index')->name('index');
    Route::get('/categories/create',  'create')->name('create');
    Route::post('/categories',  'store')->name('store');
    Route::get('/categories/{product}',  'edit')->name('edit');
    Route::put('/categories/{product}',  'update')->name('update');
});

