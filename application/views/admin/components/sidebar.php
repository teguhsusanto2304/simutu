<?php
    $uploadGambarAdmin  =   $this->path->uploadGambarAdmin;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=base_url('assets/img/magang-icon.png')?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-light">Admin TempeQU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image pr-1">
                <img src="<?=base_url($uploadGambarAdmin.'/compress/'.$detailAdmin['foto'])?>" 
                    class="img-circle elevation-2 user-profile-img" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=strtoupper($detailAdmin['nama'])?></a>
                <p class="text-sm mb-0 mt-1 text-white">Administrator</p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-header">Menu</li>
                <li class="nav-item">
                    <a href="<?=site_url(adminControllers())?>" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Homepage Website <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('hero'))?>" class="nav-link">
                                <i class="far fa-image nav-icon"></i>
                                <p>Hero Slider</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('konten'))?>" class="nav-link">
                                <i class="fa fa-list nav-icon"></i>
                                <p>Konten</p>
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