<?php
use App\Http\Controllers\ApiEmployeeController;
use App\Http\Controllers\Auth\ApiAuthenticatedSessionController;
use App\Http\Controllers\CheckinController;
use Illuminate\Support\Facades\Route;

// Routes for login and logout
Route::post('/login', [ApiAuthenticatedSessionController::class, 'storeapp']);  // Login via API
Route::post('/logout', [ApiAuthenticatedSessionController::class, 'destroyapp']); // Logout via API

// Protected Routes (require auth:api middleware)
Route::middleware('auth:api')->group(function () {
    // Check-in and Check-out Routes
    Route::post('/check-in', [CheckinController::class, 'checkIn']);    // Check-in route
    Route::post('/check-out', [CheckinController::class, 'checkOut']);  // Check-out route

    // Employee Profile Routes
    Route::get('/employee/profile', [ApiEmployeeController::class, 'edit']);   // View profile
    Route::put('/employee/profile', [ApiEmployeeController::class, 'update']);  // Update profile

    // Leave Requests Routes
    Route::post('/leave_requests', [ApiEmployeeController::class, 'storer']); // Store a new leave request
    Route::get('/leave_requests', [ApiEmployeeController::class, 'indexre']);  // Get leave requests for the authenticated employee
});

