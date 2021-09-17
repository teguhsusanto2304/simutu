<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'Homepage',
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css'),
                    base_url('assets/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css')
                ]
            ]  
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarHero   =   $this->path->uploadGambarHero;
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
            <div id="home" class="header-hero bg_cover owl-carousel owl-theme" style='height:100vh;'>
                <?php foreach($listHero as $hero){ ?>
                    <div class="hero-slider-item d-flex align-items-center" 
                        style='background:url(<?=base_url($uploadGambarHero.'/'.$hero['foto'])?>)'>
                        <div class="overlay"></div>
                        
                        <div class="container">
                            <div class="col-lg-7">
                                <div class="header-hero-content">
                                    <h1 class="hero-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s" 
                                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                                        <?=$hero['judul']?>
                                    </h1>
                                    <p class="text text-white wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s" 
                                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">
                                        <?=$hero['deskripsi']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </header>

        <section id="service" class="service-area pt-105 pb-105">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h6 class="sub-title">Produk Kami</h6>
                            <h4 class="title">
                                <span>Beberapa</span> Produk Unggulan Kami <span>antara lain</span>
                            </h4>
                        </div>
                    </div>
                </div> <!-- row -->
                <hr />
                <?php 
                    if(count($listKonten) >= 1){ 
                        foreach($listKonten as $konten){
                            $idKonten           =   $konten['id'];

                            $kontenItemOptions  =   [
                                'select'    =>  'id, foto, nama, harga, diskon, deskripsi',
                                'where'     =>  ['idKonten' => $idKonten]
                            ];
                            $listKontenItem     =   $this->kontenItem->getKontenItem(null, $kontenItemOptions);
                ?>
                        
                <div class="service-wrapper mt-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.6s">
                    <h4 class='mb-2'><?=$konten['namaDivisi']?></h4>
                    <p class="text-sm text-muted text-justify"><?=$konten['deskripsiDivisi']?></p>
                    <div class="row no-gutters justify-content-center pt-2">
                            <?php
                                $itemExist  =   false;
                                if(count($listKontenItem) >= 1){
                                    ?>    
                                    <div class="konten-produk owl-carousel owl-theme">
                                        <?php
                                            $itemExist              =   true;
                                            $uploadGambarKontenItem =   $this->path->uploadGambarKontenItem;

                                            foreach($listKontenItem as $kontenItem){
                                                $dataProdukCard         =   [
                                                    'uploadGambarKontenItem'    =>  $uploadGambarKontenItem,
                                                    'kontenItem'                =>  $kontenItem
                                                ];
                                                $this->load->view(websiteComp('produk-card'), $dataProdukCard);
                                            }
                                        ?>
                                    </div>
                            <?php
                                }else{
                                    ?>
                                        <div class='py-4 text-center'>
                                            <img src="<?=base_url('assets/img/empty.png')?>" alt="Tidak Ada Konten" style='width:150px; opacity:.25;' />
                                            <p class="text-sm text-muted mb-0">Tidak ada produk di dalam konten <b>"<?=$konten['namaDivisi']?>"</b></p>
                                        </div>
                                    <?php
                                }
                            ?>
                    </div>
                    <?php if($itemExist){ ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="service-btn text-center pt-25 pb-15">
                                    <button class="main-btn main-btn-2 beli-semua" id='<?=$idKonten?>'>
                                        <span class="lni lni-cart mr-2"></span>    
                                        Beli Semua
                                    </button>
                                </div> <!-- service btn -->
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                        }
                    }
                ?>
            </div> <!-- container -->
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php 
            $javascriptOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')
                    ]
                ]
            ];
            $this->load->view(websiteComp('javascript'), $javascriptOptions); 
        ?>
    </body>
</html>
<style type='text/css'>
    #home .owl-dots{
        margin: 0;
        position: absolute;
        bottom: 35px;
        left: 50%;
        transform: translateX(-50%);
    }
    #hero .owl-dot > span{
        background-color:#fff !important;
    }
    .owl-dot.active > span{
        width:50px !important;
        transition: .35s ease !important;
        background-color:#3dc257 !important;
    }
    .hero-slider-item{
        position: relative;
        width:100%;
        height:100%;
        background-size:cover !important;
    }
    .hero-slider-item > .overlay{
        position: absolute;
        top:0;
        left:0;
        bottom:0;
        right:0;
        width:100%;
        height:100%;
        background:rgba(0, 0, 0, 0.4);
    }
    .header-hero-content .hero-title{
        color:#fff;
    }
    .service-wrapper{
        box-shadow:none !important;
    }
    .produk-rating{
        font-size:1.0rem
    }
    .produk-card{
        border-radius: 15px;
        box-shadow: 0 4px 20px #f4f4f4;
    }
    .owl-item{
        transition: .5s ease;
    }
    .owl-item.active.center{
        margin-top: -25px;
    }
    .konten-produk .owl-stage{
        padding-top:2rem;
        padding-bottom:2rem;
    }
    .shadow{
        box-shadow: 0 4px 20px #c9c9c9;
    }
    .produk-img{
        position:relative;
    }
    .produk-img > .badge-diskon{
        position: absolute;
        top: 10px;
        right : 10px;
    }
    .produk-card > .produk-img > img{
        width: 7.5rem;
        height: 7.5rem;
        border-radius: 50%;
    }
</style>
<script language='Javascript'>
    $('#home').owlCarousel({
        items:1,
        autoplay:true,
        autoplaySpeed: 1000
    });
    $('.konten-produk').owlCarousel({
        loop:true,
        margin:10,
        center:true,
        responsive : {
            0 : {
                items   :   2
            },
            480 : {
                items   :   3
            },
            768 : {
                items   :   5
            }
        }
    });
    
    $('.btn-beli').on('click', function(e){
        e.preventDefault();
        
        let _el             =   $(this);
        let _idKontenItem   =   _el.attr('id');
        let _data           =   `idKontenItem=${_idKontenItem}`;

        let _btnHTML    =   _el.html();
        _el.prop('disabled', true).html('<b>Processing ...</b>');

        $.ajax({
            url     :   '<?=site_url('keranjang/process_add')?>',
            data    :   _data,
            type    :   'POST',
            success :   function(decodedRFS){
                 _el.prop('disabled', false).html(_btnHTML);

                let _audio  =   new Audio('<?=base_url('assets/sounds/bell.mp3')?>');

                let _statusAddCart  =   decodedRFS.statusAddCart;
                if(_statusAddCart){
                    _audio.play();
                }else{
                    let _message    =   decodedRFS.message;
                    Swal.fire({
                        title   :   'Keranjang',
                        html    :   `Gagal menambahkan produk ke keranjang, coba lagi ya!<br /><b class='text-danger'>${_message}</b>`,
                        icon    :   'error'
                    });
                }
            }
        });
    });
    
    $('.beli-semua').on('click', function(e){
        e.preventDefault();

        let _el         =   $(this);
        let _btnText    =   _el.text();

        _el.prop('disabled', true).text('Processing ...');
        
        let _idKonten   =   $(this).attr('id');
        let _data       =   `idKonten=${_idKonten}`;

        $.ajax({
            url     :   '<?=site_url('keranjang/process_addAll')?>',
            data    :   _data,
            type    :   'POST',
            success :   function(decodedRFS){
                _el.prop('disabled', false).text(_btnText);

                let _audio  =   new Audio('<?=base_url('assets/sounds/bell.mp3')?>');

                let _statusAddCart  =   decodedRFS.statusAddCart;
                if(_statusAddCart){
                    _audio.play();
                }else{
                    let _message    =   decodedRFS.message;
                    Swal.fire({
                        title   :   'Keranjang',
                        html    :   `Gagal menambahkan semua produk ke keranjang, coba lagi ya!<br /><b class='text-danger'>${_message}</b>`,
                        icon    :   'error'
                    });
                }
            }
        });
    });
</script>