<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view(userComponents('head'), ['pageTitle' => 'Dashboard']); ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <?php $this->load->view(userComponents('preloader')); ?>
            <?php $this->load->view(userComponents('navbar')); ?>
            <?php $this->load->view(userComponents('sidebar')); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php $this->load->view(userComponents('content-header')); ?>
            </div>
            <!-- /.content-wrapper -->
            
            <?php $this->load->view(userComponents('footer')); ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view(userComponents('javascript')); ?>
    </body>
</html>
