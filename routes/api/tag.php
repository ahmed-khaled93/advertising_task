<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagController;

// All route names are prefixed with 'api.tag'.

Route::group(['prefix' => 'tag'], function () {
   Route::get('list', [TagController::class, 'index'])->name('tags');
   Route::post('store', [TagController::class, 'store'])->name('tag.store');
   Route::group(['prefix' => '{tag}'], function () {
      Route::get('show', [TagController::class, 'show'])->name('tag.show');
  		Route::patch('update', [TagController::class, 'update'])->name('tag.update');
  		Route::delete('destroy', [TagController::class, 'destroy'])->name('tag.destroy');
  	});
});
