<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bestlink College of the Philippines</title>
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
            /* Switched back to Poppins */
            font-family: 'Poppins', sans-serif;
            font-weight: 300; /* Default to the lighter weight */
        }
        /* Apply bold font weight to headings and other elements */
        h1, h2, h3, h4, h5, h6, .fw-bold {
            font-weight: 5  00 !important;
        }
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background-color: #1e3a8a;
            transition: margin-left 0.3s ease-in-out;
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
            width: calc(100% - 280px);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: width 0.3s ease-in-out;
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

        /* Styles for collapsed sidebar */
        body.sidebar-collapsed .sidebar {
            margin-left: -280px;
        }
        body.sidebar-collapsed .main-content-wrapper {
            width: 100%;
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
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
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
                    <span id="current-time" class="me-3"></span>
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
    </div>

    <script>
        // Sidebar Toggle Functionality
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-collapsed');
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
