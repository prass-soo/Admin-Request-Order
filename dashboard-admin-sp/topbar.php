<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: #000; position: relative;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Teks pada Topbar -->
    <div class="navbar-text ml-3 font-weight-bold text-light">
        REQUEST ORDER PART MONITORING
    </div>

    <hr class="sidebar-divider" style="background-color: #ff0000; position: absolute; bottom: 0; left: 0; right: 0; height: 3px; margin: 0;">



    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- Ganti tag <img> dengan ikon user dari Font Awesome -->

                <span class="mr-2 d-none d-lg-inline text-light small">Admin Sparepart</span>
                <i class="fas fa-user-circle fa-lg text-light"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="./admin/logout.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Anda yakin ingin keluar?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- End of Topbar -->