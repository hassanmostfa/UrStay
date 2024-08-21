<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UnitsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::controller(AuthController::class)->group(function () {
    //Register Routes
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerSave')->name('register.save');
    //Login Routes
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginAction')->name('login.action');
    //Logout Route
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

//Normal user routes

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return redirect()->route('logout');
});

// Admin routes
Route::middleware('auth' , 'user_access:admin')->group(function () {
    // Admin Features
    Route::get('/admin/home', [HomeController::class,'adminHome'])->name('admin/home');
    Route::get('/admin/user/create', [AdminController::class,'create'])->name('admin/user/create');
    Route::post('/admin/user/store', [AdminController::class,'store'])->name('admin/user/store');
    Route::get('/admin/user/edit/{id}', [AdminController::class,'edit'])->name('admin/user/edit');
    Route::put('/admin/user/update/{id}', [AdminController::class,'update'])->name('admin/user/update');
    Route::delete('/admin/user/destroy/{id}', [AdminController::class,'destroy'])->name('admin/user/destroy');

    // Categories Features
    Route::get('/admin/categories', [CategoriesController::class,'index'])->name('admin/categories');
    Route::get('/admin/categories/create', [CategoriesController::class,'create'])->name('admin/categories/create');
    Route::post('/admin/categories/store', [CategoriesController::class,'store'])->name('admin/categories/store');
    Route::get('/admin/categories/edit/{id}', [CategoriesController::class,'edit'])->name('admin/categories/edit');
    Route::post('/admin/categories/update/{id}', [CategoriesController::class,'update'])->name('admin/categories/update');
    Route::get('/admin/categories/destroy/{id}', [CategoriesController::class,'destroy'])->name('admin/categories/destroy');
});

Route::middleware('auth' , 'user_access:owner')->group(function () {
    // Owner Features
    // Route::get('/owner/dashboard', [HomeController::class,'ownerHome'])->name('owner/dashboard');
    Route::get('/owner/dashboard', [UnitsController::class,'index'])->name('owner/dashboard');
    Route::get('/owner/unit/create', [UnitsController::class,'create'])->name('owner/create-unit');
    Route::post('/owner/unit/store', [UnitsController::class,'store'])->name('owner/store-unit');
    Route::get('/owner/unit/edit/{id}', [UnitsController::class,'edit'])->name('owner/unit/edit');
    Route::post('/owner/unit/update/{id}', [UnitsController::class,'update'])->name('owner/unit/update');
    Route::get('/owner/destroy/{id}', [UnitsController::class,'destroy'])->name('owner/unit/destroy');

});