<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo300.png') }}">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7f6;
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
        }
        h1, h2, h3, h4, h5, h6, .fw-bold {
            font-weight: 700 !important;
        }
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background-color: #1e3a8a;
            transition: margin-left 0.3s ease-in-out;
            position: fixed; /* Keep sidebar fixed */
            z-index: 1030;
            top: 0;
            left: 0;
        }
        .sidebar .user-profile {
            padding: 1.5rem 1rem;
            text-align: center;
            color: white;
        }
        .sidebar .user-profile .initials {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #3B71CA;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 0.5rem;
        }
        .sidebar .nav-link {
            color: #bdc3c7;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            color: #ffffff;
            background-color: #284b9a;
            border-left: 3px solid #3B71CA;
        }
        .sidebar .nav-link i {
            margin-right: 0.75rem;
        }
        .main-content-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 280px; /* Default margin for desktop */
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
        }
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.5rem 1.5rem;
        }
        .content-area {
            padding: 2rem;
            flex-grow: 1;
        }
        .footer {
            padding: 1rem 2rem;
            background-color: #ffffff;
            border-top: 1px solid #dee2e6;
            font-size: 0.875rem;
            color: #6c757d;
        }

        /* New overlay style */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1029; /* Just below the sidebar's z-index */
        }

        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .sidebar {
                margin-left: -280px; /* Hide sidebar by default on smaller screens */
            }
            .main-content-wrapper {
                margin-left: 0;
                width: 100%;
            }
            body.sidebar-toggled .sidebar {
                margin-left: 0; /* Show sidebar when toggled */
            }
            /* Show overlay when sidebar is toggled on mobile */
            body.sidebar-toggled .sidebar-overlay {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div id="sidebar" class="d-flex flex-column flex-shrink-0 sidebar">
            <div class="user-profile">
                @if(Auth::check())
                    @php
                        $user = Auth::user();
                        $initials = strtoupper(substr($user->name, 0, 1) . (str_contains($user->name, ' ') ? substr(strrchr($user->name, ' '), 1, 1) : ''));
                    @endphp
                    <div class="initials">{{ $initials }}</div>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <small>{{ $user->email }}</small>
                @endif
            </div>

            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('accreditation.dashboard') }}" class="nav-link {{ request()->routeIs('accreditation.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('accreditation.documents.index') }}" class="nav-link {{ request()->routeIs('accreditation.documents.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i> Document Repository
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link disabled">
                        <i class="bi bi-journal-check"></i> SAR Builder
                    </a>
                </li>
                <li>
                    <a href="{{ route('accreditation.compliance.index') }}" class="nav-link {{ request()->routeIs('accreditation.compliance.index') ? 'active' : '' }}">
                        <i class="bi bi-list-check"></i> Compliance Matrix
                    </a>
                </li>
            </ul>
            <div class="p-3">
                <!-- This space is intentionally left blank after removing the logout button -->
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Top Navbar -->
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div>
                    <button id="sidebar-toggle" class="btn btn-light"><i class="bi bi-list"></i></button>
                </div>
                <div class="d-flex align-items-center">
                    <span id="current-time" class="me-3 d-none d-sm-inline"></span>
                    <a href="#" class="text-dark me-3"><i class="bi bi-bell fs-5"></i></a>
                    <a href="#" class="text-dark me-3"><i class="bi bi-search fs-5"></i></a>
                    
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <main class="content-area">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="footer">
                Accreditation Management System &copy; {{ date('Y') }}
            </footer>
        </div>
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay"></div>
    </div>

    <script>
        // Sidebar Toggle Functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-toggled');
        });

        // New: Close sidebar when overlay is clicked
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            document.body.classList.remove('sidebar-toggled');
        });

        // Clock Functionality
        function updateTime() {
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                const now = new Date();
                timeElement.textContent = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true });
            }
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>
</body>
</html>
