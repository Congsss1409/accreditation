@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>

        <!-- Main content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Accreditation Document Repository') }}
                </div>
                <div class="card-body">

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

                    <!-- Upload Form -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Upload New Document</h5>
                            <form action="{{ route('accreditation.documents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="name" class="form-label">Document Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="document_file" class="form-label">Select File</label>
                                    <input type="file" class="form-control" id="document_file" name="document_file" required>
                                    <small class="form-text text-muted">Max file size: 20MB.</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload Document</button>
                            </form>
                        </div>
                    </div>

                    <!-- Document List -->
                    <h5>Uploaded Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Document Name</th>
                                    <th scope="col">Uploaded At</th>
                                    <th scope="col" class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $document)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $document->created_at->format('M d, Y, h:i A') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('accreditation.documents.download', $document) }}" class="btn btn-sm btn-success">
                                            Download
                                        </a>
                                        <form action="{{ route('accreditation.documents.destroy', $document) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this document? This action cannot be undone.');">
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
                                    <td colspan="4" class="text-center">No documents have been uploaded yet.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
