<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    dd(gethostname());
    return view('welcome');
});
