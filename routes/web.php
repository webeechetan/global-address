<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductController;

use App\Http\Controllers\WebSiteController;
use App\Http\Controllers\ContactController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*--------------------------------- Website Routes ---------------------------------*/


Route::get('/',[WebSiteController::class,'index'])->name('viewIndex');
Route::post('/contact',[ContactController::class,'store'])->name('contactUs');



Route::get('/admin/login', [AuthController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticate'])->name('admin.authenticate');
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/contact',[ContactController::class,'index'])->name('admin.contact');
    Route::get('/contacts/export', [ContactController::class, 'export'])->name('contacts.export');
});

