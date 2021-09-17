<?php 
    $uploadGambarUser   =   $this->path->uploadGambarUser;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=base_url('assets/img/magang-icon.png')?>" alt="Aplikasi Magang" 
            class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-light">Aplikasi Magang</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image pr-1">
            <img src="<?=base_url($uploadGambarUser.'/compress/'.$detailUser['foto'])?>" class="img-circle elevation-2 user-profile-img"
                alt="User Image" />
            </div>
            <div class="info">
            <a href="#" class="d-block"><?=$detailUser['nama']?></a>
            <p class="text-sm mb-0 mt-1 text-white"><?=strtoupper($detailUser['level'])?></p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-header">Menu</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                    Matkul 1
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/charts/chartjs.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pertemuan 1.1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/charts/flot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pertemuan 1.2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/charts/inline.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pertemuan 1.3</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/charts/uplot.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pertemuan 1.4</p>
                        </a>
                    </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>