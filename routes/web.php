<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\ProductController;
Route::redirect('/','products');
Route::name('products.')->prefix('products')->controller(ProductController::class)->group(function(){
    Route::get('',  'index')->name('index');
    Route::get('/create',  'create')->name('create');
    Route::post('/store',  'store')->name('store');
    Route::get('/edit/{product}',  'edit')->name('edit');
    Route::put('/update/{product}',  'update')->name('update');
});


