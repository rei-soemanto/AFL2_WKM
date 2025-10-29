<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

// Public
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

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Admin Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Product Routes
    Route::get('/products', [AdminController::class, 'listProducts'])->name('admin.products.list');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    // Service Routes
    Route::get('/services', [AdminController::class, 'listServices'])->name('admin.services.list');
    Route::get('/services/create', [AdminController::class, 'createService'])->name('admin.services.create');
    Route::post('/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::get('/services/{id}/edit', [AdminController::class, 'editService'])->name('admin.services.edit');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/services/{id}', [AdminController::class, 'destroyService'])->name('admin.services.destroy');

    // Project Routes
    Route::get('/projects', [AdminController::class, 'listProjects'])->name('admin.projects.list');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'destroyProject'])->name('admin.projects.destroy');

});