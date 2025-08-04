<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Accreditation\DashboardController;
use App\Http\Controllers\Accreditation\DocumentController;
use App\Http\Controllers\Accreditation\ComplianceMatrixController;

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

// FIX: Redirect the root URL '/' to the accreditation dashboard's path.
Route::get('/', function () {
    // Redirecting to the path directly avoids potential route name issues.
    return redirect('dashboard');
});


// The ->name('accreditation.') part has been removed from the group
// to make route names like 'dashboard' and 'documents.index' work directly,
// matching what is used in the view files.
Route::prefix('accreditation')->group(function() {

    // This route's name is now simply 'dashboard'
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // These routes' names are now 'documents.index', 'documents.store', etc.
    Route::resource('documents', DocumentController::class)->except(['create', 'edit', 'update', 'show']);
    Route::get('documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');

    // This route's name is now simply 'compliance.index'
    Route::get('compliance-matrix', [ComplianceMatrixController::class, 'index'])->name('compliance.index');

});
