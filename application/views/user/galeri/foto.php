<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle 
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarGaleri     =   $this->path->uploadGambarGaleri;
        $uploadGambarFoto       =   $this->path->uploadGambarFoto;
        $uploadGambarAdmin      =   $this->path->uploadGambarAdmin;
        
        $detailCreator          =   $detailGaleri['detailCreator'];
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="service" class="service-area pt-130 pb-50">
            <div class="container">
                <div class="col px-xl-5 px-0">
                    <h2 class='text-black mb-3'><?=$detailGaleri['judul']?></h2>
                    <div class="col creator">
                        <div class="row">  
                            <img src="<?=base_url($uploadGambarAdmin.'/compress/'.$detailCreator['foto'])?>" 
                                alt="<?=$detailCreator['nama']?>" class='w-50-50 img-circle' />
                            <div class="col">
                                <p class="text-sm mb-0">Created by <b><?=$detailCreator['nama']?></b></p>
                                <span class="text-muted" style='font-size:.75rem;'>
                                    Posted on <?=date('D, d M Y H:i:s', strtotime($detailGaleri['createdAt']))?>
                                </span>
                                <?php 
                                    if(!is_null($detailGaleri['updatedAt'])){ 
                                        $detailUpdater  =   $detailGaleri['detailUpdater'];
                                ?>
                                    <div class="col mt-1">
                                        <div class="row">
                                            <img src="<?=base_url($uploadGambarAdmin.'/compress/'.$detailUpdater['foto'])?>" 
                                                alt="<?=$detailUpdater['nama']?>" class='w-25-25 img-circle' />
                                            <div class="col">
                                                <span class="text-muted" style='font-size:.75rem;'>
                                                    Updated by <b><?=$detailUpdater['nama']?></b> on <?=date('D, d M Y H:i:s', strtotime($detailGaleri['updatedAt']))?>
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
                <div class="col px-xl-5 px-0">
                    <div class='row'>      
                        <div class="col-lg-4">
                            <img src="<?=base_url($uploadGambarGaleri.'/'.$detailGaleri['foto'])?>" alt="<?=$detailGaleri['judul']?>"
                                class='w-100 img-foto' />
                        </div>
                        <div class="col-lg-8 mt-4 mt-lg-0 mt-md-0 mt-sm-0">   
                            <h5 class='mb-3'>Deskripsi Galeri</h5>
                            <p class="text-sm mb-0 text-muted"><?=$detailGaleri['deskripsi']?></p>
                        </div>
                    </div>
                    <hr />
                    <?php if(count($listFoto) >= 1){ ?>
                        <h5 class='mt-4'>Foto di Galeri <b class='text-success'><?=$detailGaleri['judul']?></b></h5>
                        <div class='row pt-3'>
                            <?php foreach($listFoto as $foto){ ?>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-5">
                                    <img src="<?=base_url($uploadGambarFoto.'/'.$foto['foto'])?>" alt='<?=$foto['nama']?>'
                                        class='w-100 d-block m-auto img-foto' />
                                    <br />
                                    <h5 class='text-black mt-3' mb-2><?=$foto['nama']?></h5>
                                    <p class="text-sm text-muted mb-0"><?=$foto['keterangan']?></p>
                                    <p class="text-sm text-muted mb-0">
                                        Uploaded on <b><?=date('D, d M Y', strtotime($foto['createdAt']))?></b>
                                    </p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php        
                        }else{
                            ?>
                            <div class='py-4 text-center col'>
                                <img src="<?=base_url('assets/img/empty.png')?>" alt="Tidak Ada Konten" style='width:150px; opacity:.25;' />
                                <p class="text-sm text-muted mb-0">Yah, belum foto di Galeri <b><?=$detailGaleri['judul']?></b> nih ..</b></p>
                            </div>
                            <?php
                        }
                    ?>
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
    .img-foto{
        border-radius:10px;
    }
</style>