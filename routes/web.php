<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\Accreditation\DashboardController;
use App\Http\Controllers\Accreditation\DocumentController;
use App\Http\Controllers\Accreditation\SarController;
use App\Http\Controllers\Accreditation\ComplianceController;
use App\Http\Controllers\Accreditation\AuditController;
use App\Http\Controllers\Accreditation\VisitController;
use App\Http\Controllers\Accreditation\ProgramTrackerController;
use App\Http\Controllers\Accreditation\QualificationController;
use App\Http\Controllers\Accreditation\ResourceController;
use App\Http\Controllers\Accreditation\ActionPlanController;
use App\Http\Controllers\Accreditation\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login
Route::get('/', fn() => redirect()->route('login'));

// --- AUTHENTICATION ---
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// --- ACCREDITATION MANAGEMENT SYSTEM (AMS) ---
Route::middleware(['auth'])->prefix('accreditation')->name('accreditation.')->group(function () {
    
    // 1. Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Accreditation Document Repository (Now a resource route)
    Route::resource('documents', DocumentController::class);

    // 3. Self-Assessment Report (SAR) Builder
    Route::get('/sar', [SarController::class, 'index'])->name('sar.index');

    // 4. Compliance Matrix & Criteria Tracking
    Route::get('/compliance', [ComplianceController::class, 'index'])->name('compliance.index');

    // 5. Internal Quality Audit Scheduler
    Route::get('/audits', [AuditController::class, 'index'])->name('audits.index');

    // 6. Accreditor Visit Management
    Route::get('/visits', [VisitController::class, 'index'])->name('visits.index');

    // 7. Program Accreditation Tracker
    Route::get('/programs', [ProgramTrackerController::class, 'index'])->name('programs.index');

    // 8. Faculty and Staff Qualification Tracking
    Route::get('/qualifications', [QualificationController::class, 'index'])->name('qualifications.index');
    
    // 9. Physical Facilities and Resources Monitoring
    Route::get('/resources', [ResourceController::class, 'index'])->name('resources.index');

    // 10. Continuous Improvement Action Planning
    Route::get('/action-plans', [ActionPlanController::class, 'index'])->name('action-plans.index');

    // 11. Accreditation Reports & Analytics
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});
