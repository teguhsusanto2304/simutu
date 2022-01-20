<?php
    $uploadGambarUser  =   $this->path->uploadGambarUser;
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?=base_url('assets/img/magang-icon.png')?>" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8" />
        <span class="brand-text font-weight-light">SIMUTU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image pr-1">
                <img src="<?=base_url($uploadGambarUser.'/compress/'.$detailUser['imageProfile'])?>" 
                    class="img-circle elevation-2 user-profile-img w-50-50" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=strtoupper($detailUser['firstName'])?> <?=strtoupper($detailUser['lastName'])?></a>
                <p class="text-sm mb-0 mt-1 text-white"><?=$detailUser['roleName']?></p>
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
                        <i class="nav-icon far fa-user"></i>
                        <p>Administrator <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Administrator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Administrator</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Laporan <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Standart SPMI</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Standart Program Studi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Institusi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Jurusan/Bagian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url(adminControllers('programstudi'))?>" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Program Studi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url(adminControllers('pelaksanaan'))?>" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Pelaksanaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=site_url(adminControllers('penilaian'))?>" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Penilaian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Dosen</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Pemeriksaan</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Auditor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penilaian</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Standart SPMI<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('spmi/standart'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Standart</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('spmi/substandart'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Standart</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('spmi/pernyataan'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penyataan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('spmi/indikator'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Indikator</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('spmi/indikatordokumen'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Indikator Dokumen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Pemberlakuan Indikator <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penjadwalan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('penetapan'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penetapan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('penetapan/auditor'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penetapan Auditor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Setting <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enrollment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-user"></i>
                        <p>Master Data <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penilaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tingkatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penetapan Institusi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenjang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=site_url(adminControllers('admin/add'))?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bentuk Institusi</p>
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