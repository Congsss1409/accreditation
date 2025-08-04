<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Accreditation\DashboardController;
use App\Http\Controllers\Accreditation\DocumentController;
use App\Http\Controllers\Accreditation\ComplianceMatrixController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


// Redirect root to login page for guests, or dashboard for logged-in users.
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('accreditation.dashboard');
    }
    return redirect()->route('login');
});


// All accreditation routes are now protected by the 'auth' middleware.
// Only logged-in users will be able to access them.
Route::middleware(['auth'])->prefix('accreditation')->name('accreditation.')->group(function() {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::post('documents', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');

    Route::get('compliance-matrix', [ComplianceMatrixController::class, 'index'])->name('compliance.index');

});
