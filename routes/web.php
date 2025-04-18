<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::view('/', 'jobs.index')->name('index');
});
