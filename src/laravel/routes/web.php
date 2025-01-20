<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return "hello world from laravel";
    //return view('welcome');
});
