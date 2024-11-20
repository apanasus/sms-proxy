<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProxyController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/proxy', [ProxyController::class, 'proxy']);
