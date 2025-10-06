<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Models\Product;

// // Static Pages
// Route::get('/about', [PageController::class, 'about'])->name('about');

// // Products
// Route::get('/products', [PageController::class, 'products'])->name('products');
// Route::get('/products/{id}', [PageController::class, 'productDetail'])->name('product.detail');

// // Services
// Route::get('/services', [PageController::class, 'services'])->name('services');
// Route::get('/services/{id}', [PageController::class, 'serviceDetail'])->name('service.detail');

// // Projects
// Route::get('/projects', [PageController::class, 'projects'])->name('projects');
// Route::get('/projects/{id}', [PageController::class, 'projectDetail'])->name('project.detail');

Route::get('/', function () {
    return view('about');
});

Route::get('/project', function () {
    return view('project');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/service', function () {
    return view('service');
});

Route::get('/project_detail', function () {
    return view('project_detail');
});

Route::get('/product_detail', function () {
    return view('product_detail');
});

Route::get('/service_detail', function () {
    return view('service_detail');
});