<?php

namespace App\Http\Controllers\Accreditation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $documents = Document::latest()->get();
        return view('accreditation.documents.index', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,jpg,png,zip|max:10240', // Max 10MB
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'name' => $request->name,
            'description' => $request->description,
            'file_path' => $filePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('accreditation.documents.index')->with('success', 'Document uploaded successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Document $document)
    {
        // 1. Delete the physical file from storage
        Storage::disk('public')->delete($document->file_path);

        // 2. Delete the record from the database
        $document->delete();

        // 3. Redirect back with a success message
        return redirect()->route('accreditation.documents.index')->with('success', 'Document deleted successfully!');
    }
}
