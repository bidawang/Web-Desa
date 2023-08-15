<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= session('nama') ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-images mr-2"></i>
                        <p>
                            Kelola Foto
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="/foto-carousel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Carousel</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="/photo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gallery Foto</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Gallery Photo Punya Diva -->
                <li class="nav-item">
                    <a href="/video/gallery" class="nav-link">
                        <i class="fas fa-video mr-2"></i>
                        <p>
                            Kelola Video
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/news" class="nav-link">
                        <i class="fas fa-newspaper mr-2"></i>
                        <p>
                            Kelola Berita
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/settings" class="nav-link">
                        <i class="fas fa-cog mr-2"></i>
                        <p>
                            Pengaturan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="fas fa-cog mr-2"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>