<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Chalet</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.cities.index')}}">
            <i class="fas fa-city"></i>
            <span>City</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.categories.index')}}">
            <i class="fas fa-vihara"></i>
            <span>Category</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.chalets.index')}}">
            <i class="fas fa-home"></i>
            <span>Chalet</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.comments.index')}}">
            <i class="fas fa-comments"></i>
            <span>Comment</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.contacts.index')}}">
            <i class="fas fa-inbox"></i>
            <span>Contact</span></a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{route('dashboard.customers.index')}}">
            <i class="fas fa-users"></i>
            <span>Customer</span></a>
    </li>



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
