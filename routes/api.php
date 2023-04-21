<?php

use Illuminate\Support\Facades\Route;
use Osfrportal\OrionproLaravel\Http\Controllers\OrionproController;

Route::group(['prefix'=>'osfrapi','as' => 'osfrapi.'], function(){
    Route::get('/orionpro', [OrionproController::class, 'index']);
});
