<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Osfrportal\OrionproLaravel\Http\Controllers\Api\APIOrionproControllerV1;

//'prefix' => 'api/osfr/v1/orionpro',



Route::get('/doorslog', [APIOrionproControllerV1::class, 'index'])->name('doorsevents');
Route::get('/', function () {
    return [];
})->name('index');
