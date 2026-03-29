<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InstrumentBrandController;
use App\Http\Controllers\InstrumentCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Authentication endpoints.
 *
 * POST /register   Register a new user.
 * POST /login      Authenticate a user and issue a token.
 */

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/**
 * Authenticated user endpoints.
 *
 * Requires: auth:sanctum
 *
 * POST /logout     Invalidate the current access token.
 * GET  /me         Return the authenticated user's profile.
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

/**
 * Address management endpoints.
 *
 * Requires: auth:sanctum
 *
 * GET    /addresses              List all addresses of the authenticated user.
 * GET    /addresses/{address}    Show a specific address.
 * POST   /addresses              Create a new address.
 * PUT    /addresses/{address}    Update an existing address.
 * PATCH  /addresses/{address}    Partially update an existing address.
 * DELETE /addresses              Delete an address.
 */

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/addresses', [AddressController::class, 'index']);
    Route::get('/addresses/{address}', [AddressController::class, 'show']);
    Route::post('/addresses', [AddressController::class, 'store']);
    Route::put('/addresses/{address}', [AddressController::class, 'update']);
    Route::patch('/addresses/{address}', [AddressController::class, 'update']);
    Route::delete('/addresses', [AddressController::class, 'destroy']);
});


Route::get('/instrument_brands', [InstrumentBrandController::class, 'index']);
Route::get('/instrument_brands/{brand}', [InstrumentBrandController::class, 'show']);

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/instrument_brands', [InstrumentBrandController::class, 'store']);
    Route::put('/instrument_brands/{InstrumentBrand}', [InstrumentBrandController::class, 'update']);
    Route::patch('/instrument_brands/{InstrumentBrand}', [InstrumentBrandController::class, 'update']);
    Route::delete('/instrument_brands', [InstrumentBrandController::class, 'destroy']);
});


Route::get('/instrument_categories', [InstrumentCategoryController::class, 'index']);
Route::get('/instrument_categories/{category}', [InstrumentCategoryController::class, 'show']);

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/instrument_categories', [InstrumentCategoryController::class, 'store']);
    Route::put('/instrument_categories/{InstrumentCategory}', [InstrumentCategoryController::class, 'update']);
    Route::patch('/instrument_categories/{InstrumentCategory}', [InstrumentCategoryController::class, 'update']);
    Route::delete('/instrument_categories', [InstrumentCategoryController::class, 'destroy']);
});


