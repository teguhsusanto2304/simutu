<?php 
    $currentController  =   $this->uri->segment(1);
    if(is_null($currentController) || empty($currentController)){
        $currentController  =   'home';
    }

    $currentController  =   strtolower($currentController);
?>
<div class="navbar-area headroom bg-transparent <?=($currentController === 'home')? 'homepage' : ''?>" id='topNavbar'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="<?=site_url()?>">
                        <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo" style='width:40%;' />
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar justify-content-end" id="navbarSupportedContent">
                        <ul id="nav" class="navbar-nav">
                            <li class="nav-item" data-toggle='tooltip'
                                title='Halaman Awal' data-placement='top'>
                                <a href="<?=site_url()?>">Home</a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Baca blog di sini' data-placement='top'>
                                <a href="<?=site_url('blog')?>">Blog</a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Lihat Galeri Kami di sini' data-placement='top'>
                                <a href="<?=site_url('galeri')?>">Galeri</a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Langganan ke kami' data-placement='top'>
                                <a href="<?=site_url('langganan')?>">Langganan</a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Pertanyaan Yang Sering Ditanyakan' data-placement='top'>
                                <a href="<?=site_url('faq')?>">FAQ</a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Keranjang Belanja' data-placement='top'>
                                <a href="<?=site_url('keranjang')?>">
                                    <span class="lni lni-cart" style='font-size:25px;'></span>
                                </a>
                            </li>
                            <li class="nav-item" data-toggle='tooltip'
                                title='Pilih Bahasa' data-placement='top'>
                                <span id="google_translate_element" class="translate"></span>
                                <span id="pilihBahasa"></span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>