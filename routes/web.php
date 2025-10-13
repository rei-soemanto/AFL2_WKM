<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('about');
});

// Products
Route::get('/product', [PageController::class, 'products'])->name('product');
Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');

// Services
Route::get('/service', [PageController::class, 'services'])->name('service');
Route::get('/service/{id}', [PageController::class, 'serviceDetail'])->name('service.detail');

// Projects
Route::get('/project', [PageController::class, 'projects'])->name('project');
Route::get('/project/{id}', [PageController::class, 'projectDetail'])->name('project.detail');