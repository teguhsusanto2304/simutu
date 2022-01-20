<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'Dashboard',
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/consult/css/LineIcons.css')
                ]
            ]  
        ];
        $this->load->view(adminComponents('head'), $headOptions); 
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php $this->load->view(adminComponents('preloader')); ?>            

            <?php $this->load->view(adminComponents('navbar')); ?>
            <?php $this->load->view(adminComponents('sidebar')); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>
                        </div>

                    </div>
                </div>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <?php foreach($dashboardSmallBox as $box){ ?>
                                <div class="col-lg-3 col-6">
                                    <div class="small-box <?=$box['bg']?>">
                                        <div class="inner">
                                            <h3><?=$box['numberOfData']?></h3>

                                            <p><?=$box['nameOfData']?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="<?=$box['icon']?>"></i>
                                        </div>
                                        <a href="<?=$box['seeMoreURL']?>" class="small-box-footer">
                                            Lihat <i class="fas fa-arrow-circle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->

            <?php $this->load->view(adminComponents('footer')); ?>
        </div>

        <?php $this->load->view(adminComponents('javascript')); ?>
    </body>
</html>
