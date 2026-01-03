<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Management</div>

    <li class="nav-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.departments.index') }}">
            <i class="fas fa-fw fa-building"></i>
            <span>Departments</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.services.index') }}">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Services</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.doctors.index') }}">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Doctors</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.appointments.index') }}">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Appointments</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.faqs.index') }}">
            <i class="fas fa-fw fa-question-circle"></i>
            <span>FAQs</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.testimonials.index') }}">
            <i class="fas fa-fw fa-comment-dots"></i>
            <span>Testimonials</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.galleries.index') }}">
            <i class="fas fa-fw fa-images"></i>
            <span>Galleries</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Interface</div>

    <li class="nav-item {{ request()->routeIs('admin.buttons') || request()->routeIs('admin.cards') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->routeIs('admin.buttons') || request()->routeIs('admin.cards') ? 'show' : '' }}"
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.buttons') ? 'active' : '' }}" href="{{ route('admin.buttons') }}">Buttons</a>
                <a class="collapse-item {{ request()->routeIs('admin.cards') ? 'active' : '' }}" href="{{ route('admin.cards') }}">Cards</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.utilities.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
           aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ request()->routeIs('admin.utilities.*') ? 'show' : '' }}"
             aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.utilities.colors') ? 'active' : '' }}" href="{{ route('admin.utilities.colors') }}">Colors</a>
                <a class="collapse-item {{ request()->routeIs('admin.utilities.borders') ? 'active' : '' }}" href="{{ route('admin.utilities.borders') }}">Borders</a>
                <a class="collapse-item {{ request()->routeIs('admin.utilities.animations') ? 'active' : '' }}" href="{{ route('admin.utilities.animations') }}">Animations</a>
                <a class="collapse-item {{ request()->routeIs('admin.utilities.other') ? 'active' : '' }}" href="{{ route('admin.utilities.other') }}">Other</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Addons</div>

    <li class="nav-item {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse {{ request()->routeIs('admin.pages.*') ? 'show' : '' }}"
             aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.pages.login') ? 'active' : '' }}" href="{{ route('admin.pages.login') }}">Login</a>
                <a class="collapse-item {{ request()->routeIs('admin.pages.register') ? 'active' : '' }}" href="{{ route('admin.pages.register') }}">Register</a>
                <a class="collapse-item {{ request()->routeIs('admin.pages.forgot-password') ? 'active' : '' }}" href="{{ route('admin.pages.forgot-password') }}">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item {{ request()->routeIs('admin.pages.404') ? 'active' : '' }}" href="{{ route('admin.pages.404') }}">404 Page</a>
                <a class="collapse-item {{ request()->routeIs('admin.pages.blank') ? 'active' : '' }}" href="{{ route('admin.pages.blank') }}">Blank Page</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.charts') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.charts') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li>

    <li class="nav-item {{ request()->routeIs('admin.tables') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tables') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
