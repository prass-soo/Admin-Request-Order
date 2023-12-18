<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #000;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cogs"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ROPM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" style="background-color: #ff0000;">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'successlist.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="successlist.php">
            <i class="fa fa-check-square"></i>
            <span>Daftar Permintaan Berhasil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" style="background-color: #ff0000;">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle" style="background-color: #ff0000;"></button>
    </div>

</ul>
<!-- End of Sidebar -->