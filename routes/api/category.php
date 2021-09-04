<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;

// All route names are prefixed with 'api.category'.

Route::group(['prefix' => 'category'], function () {
   Route::get('list', [CategoryController::class, 'index'])->name('categories');
   Route::post('store', [CategoryController::class, 'store'])->name('category.store');
   Route::group(['prefix' => '{category}'], function () {
      Route::get('show', [CategoryController::class, 'show'])->name('category.show');
  		Route::patch('update', [CategoryController::class, 'update'])->name('category.update');
  		Route::delete('destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
  	});
});
