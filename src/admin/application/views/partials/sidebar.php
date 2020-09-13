<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-registered" aria-hidden="true"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CMS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo FULL_BASE_URL; ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Indítópult</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Tartalom menedzser
    </div>

    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="<?php echo FULL_BASE_URL.'content/list'; ?>">
            <i class="far fa-fw fa-file"></i>
            <span>Tartalmak</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="<?php echo FULL_BASE_URL.'news/list'; ?>">
            <i class="far fa-fw fa-newspaper" aria-hidden="true"></i>
            <span>Hírek</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="<?php echo FULL_BASE_URL.'menu/list'; ?>">
            <i class="far fa-fw fa-hand-pointer"></i>
            <span>Menüpontok</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="<?php echo FULL_BASE_URL.'banner/list'; ?>">
            <i class="fab fa-fw fa-line"></i>
            <span>Bannerek</span></a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link nav-link-custom" href="<?php echo FULL_BASE_URL.'gallery/list'; ?>">
            <i class="far fa-fw fa-images"></i>
            <span>Galériák</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block margin-top-1rem">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->