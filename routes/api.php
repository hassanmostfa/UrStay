<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\UnitsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth APIS 
Route::post('/register', [AuthController::class, 'register']); // Register new user API
Route::post('/login', [AuthController::class, 'login']); // Login user API
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Logout user API


Route::middleware('auth:sanctum')->group (function () {
    // User APIS 
    Route::get('/users', [UserController::class, 'showAllUsers']); // Show all users API
    Route::get('/users/{id}', [UserController::class, 'showOneUser']); // Show one user API by id
    Route::put('/users/update/{id}', [UserController::class, 'update']); // Update user API by id
    Route::delete('/users/destroy/{id}', [UserController::class, 'destroy']); // Delete user API by id

    // Category APIS
    Route::get('/categories', [CategoriesController::class, 'showAllCategories']); // Show all categories API
    Route::post('/categories/create', [CategoriesController::class, 'createCategory']); // Create category API
    Route::get('/categories/{id}', [CategoriesController::class, 'showOneCategory']); // Show one category API by id
    Route::put('/categories/update/{id}', [CategoriesController::class, 'updateCategory']); // Update category API by id
    Route::delete('/categories/destroy/{id}', [CategoriesController::class, 'destroyCategory']); // Delete category API by id

    // Unit APIS
    Route::get('/units', [UnitsController::class, 'showAllUnits']); // Show all units API
    Route::post('/units/create', [UnitsController::class, 'createUnit']); // Create unit API
    Route::get('/units/{id}', [UnitsController::class, 'showOneUnit']); // Show one unit API by id
    Route::put('/units/update/{id}', [UnitsController::class, 'updateUnit']); // Update unit API by id
    Route::delete('/units/destroy/{id}', [UnitsController::class, 'destroyUnit']); // Delete unit API by id
});