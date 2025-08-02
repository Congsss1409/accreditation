<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accreditation Management System</title>
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white" style="width: 280px; min-height: 100vh; background-color: #0d47a1;">
            <a href="/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <img src="{{ asset('images/logo300.png') }}" alt="School Logo" class="me-2" width="60" height="70">
                <span class="fs-4">SMSIII AMS</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link text-white d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('documents.index') }}" class="nav-link text-white d-flex align-items-center {{ request()->routeIs('documents.index') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i> Document Repository
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-journal-check me-2"></i> SAR Builder
                    </a>
                </li>
                <li>
                    <a href="{{ route('compliance.index') }}" class="nav-link text-white d-flex align-items-center {{ request()->routeIs('compliance.index') ? 'active' : '' }}">
                        <i class="bi bi-card-checklist me-2"></i> Compliance Matrix
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-calendar-event me-2"></i> Audit Scheduler
                    </a>
                </li>
                 <li>
                    <a href="#" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-people me-2"></i> Visit Management
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 p-4" style="background-color: #f8f9fa;">
            <header class="bg-white shadow-sm p-3 mb-4 rounded">
                <h1 class="h3">@yield('header')</h1>
            </header>
            
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
