<?php

namespace App\Http\Controllers\Accreditation;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For now, we will get all documents. We will add user-specific logic later.
        $documents = Document::latest()->get();
        return view('accreditation.documents.index', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'document_file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,png|max:20480', // 20MB Max
        ]);

        $file = $request->file('document_file');
        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $sanitizedFileName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalFileName);
        $fileName = time() . '_' . $sanitizedFileName . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs('documents', $fileName, 'local');

        Document::create([
            'name' => $request->name,
            'file_path' => $filePath,
            'file_type' => $file->getClientMimeType(),
            'user_id' => 1, // We will replace this with Auth::id() once auth is set up
        ]);

        return redirect()->route('accreditation.documents.index')
                         ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Downloads the specified document.
     */
    public function download(Document $document)
    {
        if (!Storage::disk('local')->exists($document->file_path)) {
            return redirect()->route('accreditation.documents.index')
                             ->with('error', 'File not found.');
        }

        return Storage::disk('local')->download($document->file_path, $document->name . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        Storage::disk('local')->delete($document->file_path);
        $document->delete();

        return redirect()->route('accreditation.documents.index')
                         ->with('success', 'Document deleted successfully.');
    }
}
