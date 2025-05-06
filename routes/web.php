<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hot-reload-test', function () {
    return view('hot-reload-test');
});
