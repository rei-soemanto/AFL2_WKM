<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;

Auth::routes();

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

// User Interest
Route::get('/user_interest', [PageController::class, 'myInterests'])->middleware('auth')->name('user.interests');
Route::post('/product/{id}/add-interest', [PageController::class, 'addInterestedProduct'])->middleware('auth')->name('interest.product.store');
Route::post('/service/{id}/add-interest', [PageController::class, 'addInterestedService'])->middleware('auth')->name('interest.service.store');
Route::delete('/user_interest/product/{id}', [PageController::class, 'destroyInterestedProduct'])->middleware('auth')->name('interest.product.destroy');
Route::delete('/user_interest/service/{id}', [PageController::class, 'destroyInterestedService'])->middleware('auth')->name('interest.service.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/storage-link', function () {
    try {
        Artisan::call('storage:link');
        return 'Storage link created successfully!';
    } catch (Exception $e) {
        Log::error('Error creating storage link: ' . $e->getMessage());
        return 'Error creating storage link. Check logs.';
    }
});