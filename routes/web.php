<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DataShowController;

Route::get('/', [DataShowController::class, 'index'])->name('index');
