<?php

namespace App\Http\Controllers\Accreditation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document; // Import the Document model

class DashboardController extends Controller
{
    /**
     * Display the accreditation dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Gather statistics for the dashboard
        $documentCount = Document::count();
        
        // You can add more stats here as we build other modules
        // $sarCount = SelfAssessmentReport::count();
        // $upcomingAudits = Audit::where('date', '>=', now())->count();

        return view('accreditation.dashboard', [
            'documentCount' => $documentCount,
        ]);
    }
}
