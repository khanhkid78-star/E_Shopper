<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Trang chủ
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu', [HomeController::class, 'index']);

// Trang sản phẩm
Route::get('/product', function () {
    return view('pages.product');
});

// Trang tin tức
Route::get('/news', function () {
    return view('pages.news');
});

// Trang liên hệ
Route::get('/contact', function () {
    return view('pages.contact');
});