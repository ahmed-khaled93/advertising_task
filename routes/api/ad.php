<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdController;

// All route names are prefixed with 'api.ad'.

Route::group(['prefix' => 'ad'], function () {
   Route::get('list', [AdController::class, 'index'])->name('ads');
   Route::post('store', [AdController::class, 'store'])->name('ad.store');
   Route::group(['prefix' => '{ad}'], function () {
      Route::get('show', [AdController::class, 'show'])->name('ad.show');
  		Route::patch('update', [AdController::class, 'update'])->name('ad.update');
  		Route::delete('destroy', [AdController::class, 'destroy'])->name('ad.destroy');
  	});
});
