<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/clients', [HomeController::class, 'clients'])->name('clients');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [HomeController::class, 'blogPost'])->name('blog.single');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/request-service', [HomeController::class, 'requestService'])->name('request-service');
Route::post('/request-service', [HomeController::class, 'submitServiceRequest'])->name('request-service.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Services CRUD
    Route::resource('services', ServiceController::class)->except(['create', 'show', 'edit']);

    // Projects CRUD
    Route::resource('projects', ProjectController::class)->except(['create', 'show', 'edit']);

    // Clients CRUD
    Route::resource('clients', ClientController::class)->except(['create', 'show', 'edit']);

    // Blog Posts CRUD
    Route::resource('blog', BlogController::class)->except(['create', 'show', 'edit']);

    // Contact Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::patch('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Service Requests
    Route::get('/service-requests', [ServiceRequestController::class, 'index'])->name('service-requests.index');
    Route::patch('/service-requests/{serviceRequest}/status', [ServiceRequestController::class, 'updateStatus'])->name('service-requests.status');
    Route::delete('/service-requests/{serviceRequest}', [ServiceRequestController::class, 'destroy'])->name('service-requests.destroy');

    // Users CRUD
    Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});
