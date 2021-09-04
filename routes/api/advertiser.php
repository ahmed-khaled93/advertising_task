<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

// All route names are prefixed with 'api.advertiser'.

Route::group(['prefix' => 'advertiser'], function () {

  Route::group(['prefix' => '{user}'], function () {
    Route::get('ads', [UserController::class, 'ads'])->name('advertiser.ads');
  });

});
