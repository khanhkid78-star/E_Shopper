<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

// Menu Home
Route::get('/trang-chu', [HomeController::class, 'index']);