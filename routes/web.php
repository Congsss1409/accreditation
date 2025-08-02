<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accreditation\DashboardController;
use App\Http\Controllers\Accreditation\DocumentController;
use App\Http\Controllers\Accreditation\ComplianceMatrixController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect the root URL to the dashboard.
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route for the main dashboard.
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes for the Document Repository
Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

// Route for the Compliance Matrix
Route::get('/compliance-matrix', [ComplianceMatrixController::class, 'index'])->name('compliance.index');
