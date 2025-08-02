@extends('layouts.app')

@section('header', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Card: Document Repository -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Document Repository</h5>
                </div>
                <div class="card-body">
                    <p class="card-text fs-4">{{ $stats['documents_count'] }} Documents</p>
                </div>
                <div class="card-footer">
                    <a href="/documents" class="text-primary">View all</a>
                </div>
            </div>
        </div>

        <!-- Card: Program Accreditation Tracker -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Program Accreditation Tracker</h5>
                </div>
                <div class="card-body">
                    <p class="card-text fs-4">{{ $stats['programs_pending'] }} Programs Pending</p>
                </div>
                 <div class="card-footer">
                    <a href="#" class="text-primary">View all</a>
                </div>
            </div>
        </div>
        
        <!-- Card: Upcoming Visits -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                     <h5 class="card-title mb-0">Accreditor Visit Management</h5>
                </div>
                <div class="card-body">
                    <p class="card-text fs-4">{{ $stats['upcoming_visits'] }} Upcoming Visits</p>
                </div>
                 <div class="card-footer">
                    <a href="#" class="text-primary">View schedule</a>
                </div>
            </div>
        </div>
    </div>
@endsection
