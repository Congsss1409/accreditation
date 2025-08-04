@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('accreditation.dashboard') }}">Accreditation</a></li>
        <li class="breadcrumb-item active" aria-current="page">Document Repository</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold">Document Repository</h3>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Upload Form Card -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title mb-3">Upload New Document</h5>
        <form action="{{ route('accreditation.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Document Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="document_file" class="form-label">Select File</label>
                    <input type="file" class="form-control" id="document_file" name="document_file" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end">
                <i class="bi bi-upload me-2"></i>Upload Document
            </button>
        </form>
    </div>
</div>

<!-- Document List Card -->
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="card-title mb-3">Uploaded Documents</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Document Name</th>
                        <th scope="col">File Type</th>
                        <th scope="col">Uploaded At</th>
                        <th scope="col" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                    <tr>
                        <td>{{ $document->name }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $document->file_type }}</span>
                        </td>
                        <td>{{ $document->created_at->format('M d, Y, h:i A') }}</td>
                        <td class="text-end">
                            <a href="{{ route('accreditation.documents.download', $document) }}" class="btn btn-sm btn-success">
                                Download
                            </a>
                            <form action="{{ route('accreditation.documents.destroy', $document) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this document?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">No documents have been uploaded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
