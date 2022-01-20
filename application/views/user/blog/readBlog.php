<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle 
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarBlog   =   $this->path->uploadGambarBlog;
        $uploadGambarAdmin  =   $this->path->uploadGambarAdmin;
        
        $detailCreator      =   $detailBlog['detailCreator'];
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="service" class="service-area pt-130 pb-50">
            <div class="container">
                <div class="col px-xl-5 px-0">
                    <h2 class='text-black mb-3'><?=$detailBlog['title']?></h2>
                    <div class="col creator">
                        <div class="row">  
                            <img src="<?=base_url($uploadGambarAdmin.'/compress/'.$detailCreator['foto'])?>" 
                                alt="<?=$detailCreator['nama']?>" class='w-50-50 img-circle' />
                            <div class="col">
                                <p class="text-sm mb-0">Created by <b><?=$detailCreator['nama']?></b></p>
                                <span class="text-muted" style='font-size:.75rem;'>
                                    Posted on <?=date('D, d M Y H:i:s', strtotime($detailBlog['createdAt']))?>
                                </span>
                                <?php 
                                    if(!is_null($detailBlog['updatedAt'])){ 
                                        $detailUpdater  =   $detailBlog['detailUpdater'];
                                ?>
                                    <div class="col mt-1">
                                        <div class="row">
                                            <img src="<?=base_url($uploadGambarAdmin.'/compress/'.$detailUpdater['foto'])?>" 
                                                alt="<?=$detailUpdater['nama']?>" class='w-25-25 img-circle' />
                                            <div class="col">
                                                <span class="text-muted" style='font-size:.75rem;'>
                                                    Updated by <b><?=$detailUpdater['nama']?></b> on <?=date('D, d M Y H:i:s', strtotime($detailBlog['updatedAt']))?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr />
                </div>
                <div class="col px-xl-5 px-0 pt-3 pb-5">
                    <img src="<?=base_url($uploadGambarBlog.'/'.$detailBlog['foto'])?>" alt="<?=$detailBlog['title']?>"
                        class='w-100' style='border-radius: 15px;' />
                </div>
                <div class="col px-xl-5 px-0 pb-5" id='blogContent'>
                    <?=$detailBlog['content']?>
                </div>
                <div class="col text-center text-sm">
                    <p class="mb-1">Made by <b><?=$detailCreator['nama']?></b> with <span class="ml-1 fa fa-heart" style='color:#ff2a4f;'></span></p>
                </div>
            </div>
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php 
            $this->load->view(websiteComp('javascript')); 
        ?>
    </body>
</html>
<style type="text/css">
    #blogContent * {
        all:revert;
    }
</style>