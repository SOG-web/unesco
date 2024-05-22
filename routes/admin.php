<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    dd('Admin Dashboard', auth()->user()->role);
});
