<div class="sidebar" style="width: 280px; background-color: #f8f9fa;">
    <div class="p-3">
        <h4>Accreditation Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('accreditation.dashboard') ? 'active' : '' }}" href="{{ route('accreditation.dashboard') }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('accreditation.documents.*') ? 'active' : '' }}" href="{{ route('accreditation.documents.index') }}">
                    Accreditation Document Repository
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    Self-Assessment Report (SAR) Builder
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">
                    Compliance Matrix & Criteria Tracking
                </a>
            </li>
            <!-- Add other links here as we build them -->
        </ul>
    </div>
</div>
