@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Accreditation Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}! Here's an overview of the system.</p>
    </div>

    {{-- 1. Stat Cards Section --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Documents Card -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="bg-blue-500 text-white rounded-full p-3">
                    <i class="fas fa-file-alt fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Total Documents</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $documentCount }}</p>
                </div>
            </div>
        </div>

        <!-- SAR Reports Card (Placeholder) -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="bg-green-500 text-white rounded-full p-3">
                    <i class="fas fa-book-open fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">SAR Reports</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Audits Card (Placeholder) -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="bg-yellow-500 text-white rounded-full p-3">
                    <i class="fas fa-calendar-check fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Upcoming Audits</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>

        <!-- Compliance Status Card (Placeholder) -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center">
                <div class="bg-red-500 text-white rounded-full p-3">
                    <i class="fas fa-tasks fa-2x"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Action Plans</p>
                    <p class="text-2xl font-bold text-gray-800">0</p>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. Quick Access Section --}}
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quick Access</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <a href="{{ route('accreditation.documents.index') }}" class="text-center p-4 bg-gray-100 rounded-lg hover:bg-blue-100 transition-colors duration-300">
                <i class="fas fa-folder-open fa-3x text-blue-500 mb-2"></i>
                <p class="font-semibold text-gray-700">Documents</p>
            </a>
            <a href="{{ route('accreditation.sar.index') }}" class="text-center p-4 bg-gray-100 rounded-lg hover:bg-green-100 transition-colors duration-300">
                <i class="fas fa-book fa-3x text-green-500 mb-2"></i>
                <p class="font-semibold text-gray-700">SAR Builder</p>
            </a>
            <a href="{{ route('accreditation.compliance.index') }}" class="text-center p-4 bg-gray-100 rounded-lg hover:bg-yellow-100 transition-colors duration-300">
                <i class="fas fa-clipboard-list fa-3x text-yellow-500 mb-2"></i>
                <p class="font-semibold text-gray-700">Compliance</p>
            </a>
             <a href="{{ route('accreditation.audits.index') }}" class="text-center p-4 bg-gray-100 rounded-lg hover:bg-purple-100 transition-colors duration-300">
                <i class="fas fa-calendar-alt fa-3x text-purple-500 mb-2"></i>
                <p class="font-semibold text-gray-700">Audits</p>
            </a>
            <a href="{{ route('accreditation.reports.index') }}" class="text-center p-4 bg-gray-100 rounded-lg hover:bg-red-100 transition-colors duration-300">
                <i class="fas fa-chart-pie fa-3x text-red-500 mb-2"></i>
                <p class="font-semibold text-gray-700">Reports</p>
            </a>
        </div>
    </div>

</div>
@endsection
