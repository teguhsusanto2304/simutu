<?php 
    $uploadGambarUser   =   $this->path->uploadGambarUser;
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light pr-4">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown d-flex align-items-center ml-2">
            <a href='#' data-toggle='dropdown'>
                <img src="<?=base_url($uploadGambarUser.'/compress/'.$detailUser['imageProfile'])?>" class="img-circle mr-2" 
                    alt="User Image" style='width:35px; height:35px;' />
                <span class="text-sm"><?=strtoupper($detailUser['firstName'])?> <?=strtoupper($detailUser['lastName'])?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header text-left">Your Menu</span>
                <div class="dropdown-divider"></div>
                <a href="<?=site_url(adminControllers('admin/profil'))?>" class="dropdown-item">
                    <span class='fa fa-user-alt mr-2 text-muted'></span>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?=site_url(adminControllers('auth/logout'))?>" class="dropdown-item">
                    <span class='fa fa-power-off text-muted mr-2'></span>
                    Sign Out
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->