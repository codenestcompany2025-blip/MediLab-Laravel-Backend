<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('doctor.dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-md"></i>
        </div>

        <div class="sidebar-brand-text mx-2 text-nowrap">
            Doctor Panel
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('doctor.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Appointments -->
    <li class="nav-item {{ request()->routeIs('doctor.appointments.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('doctor.appointments.index') }}">
            <i class="fas fa-fw fa-calendar-check"></i>
            <span>Appointments</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (optional but recommended) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
