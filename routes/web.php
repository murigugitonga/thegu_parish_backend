<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('tail');
});
Route::get('/tail', function(){
    return view('welcome');
});
