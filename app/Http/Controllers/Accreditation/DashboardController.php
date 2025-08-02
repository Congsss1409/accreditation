<?php

namespace App\Http\Controllers\Accreditation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the accreditation dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        // This is where you would make API calls to your other microservices.
        // For now, we are simulating the data that would be returned.
        $stats = [
            'documents_count' => 1234,
            'programs_pending' => 5,
            'upcoming_visits' => 2,
        ];

        // The view function returns the specified view.
        // We are passing the $stats array to the view.
        return view('accreditation.dashboard', [
            'stats' => $stats
        ]);
    }
}
