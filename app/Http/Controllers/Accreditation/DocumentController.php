<?php

namespace App\Http\Controllers\Accreditation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        // In a real application, you would fetch this from your Document Service API.
        // $response = Http::get(config('app.document_service_url') . '/api/documents');
        // $documents = $response->successful() ? $response->json('data', []) : [];

        // For now, we'll simulate the data.
        $documents = [
            ['id' => 1, 'name' => 'Self-Assessment Report 2024', 'type' => 'PDF', 'uploaded_at' => '2024-07-15'],
            ['id' => 2, 'name' => 'Faculty Profile Compendium', 'type' => 'Word', 'uploaded_at' => '2024-07-12'],
            ['id' => 3, 'name' => 'Curriculum Evidences Q1', 'type' => 'ZIP', 'uploaded_at' => '2024-07-10'],
            ['id' => 4, 'name' => 'Compliance Matrix Sheet', 'type' => 'Excel', 'uploaded_at' => '2024-07-09'],
        ];

        return view('accreditation.documents.index', [
            'documents' => $documents
        ]);
    }
}
