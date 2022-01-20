<?php 
    if(!isset($pageTitle)){
        $pageTitle  =   'TempeQu';
    }
?>
<head>
    <meta charset="utf-8">
    <title><?=$pageTitle?></title>
    
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:description" content="TempeQu merupakan usaha mikro yang di produksi oleh Pondok Pesatren Taruna  Al-Qolam yang didirikan pada tahun 2018. TempeQu menggunakan kacang kedelai pilihan dan dikemas secara higienis dan sehat. Kedelai Premium non-GMO menjadi bahan utama TempeQu" />
    <meta property="og:image" content="<?=base_url('assets/img/icon.png')?>">

    <link rel="shortcut icon" href="<?=base_url('assets/img/icon.png')?>" type="image/png">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/slick.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/LineIcons.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/animate.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/magnific-popup.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/default.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/consult/css/style.css')?>">

    <?php 
        if(isset($morePackages)){
            if(is_array($morePackages)){
                if(array_key_exists('css', $morePackages)){
                    $moreCSS     =   $morePackages['css'];

                    if(is_array($moreCSS)){
                        foreach($moreCSS as $css){
                            ?>
                            <link rel="stylesheet" href="<?=$css?>" />
                            <?php
                        }
                    }
                }
            }
        }
    ?>
    <style type='text/css'>
        
    .img-blog{
        height:180px;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgb(38 37 37 / 25%);
    }
        .img-circle{
            border-radius:50%;
        }
        .coming-soon{
            opacity: 0.5;
        }
        .w-50-50{
            width:50px !important;
            height:50px !important;
        }
        .w-25-25{
            width:25px !important;
            height:25px !important;
        }
        .cp{
            cursor: pointer;
        }
        /*Google Translate Effect*/
        iframe.goog-te-banner-frame.skiptranslate{
            display:none;
        }
        body{
            position: unset !important;
            min-height: unset !important;
            top: unset !important;
        }
        .goog-te-gadget-simple{
            background-color: unset !important;
            border-left: unset !important;
            border-top: unset !important;
            border-bottom: unset !important;
            border-right: unset !important;
            font-size: unset !important;
            display: unset !important;
            padding-top: unset !important;
            padding-bottom: unset !important;
            cursor: unset !important;
            zoom: 1;
        }
        .goog-te-gadget-icon{
            display:none;
        }
        .goog-tooltip {
            display: none !important;
        }
        .goog-tooltip:hover {
            display: none !important;
        }
        .goog-text-highlight {
            background-color: transparent !important;
            border: none !important; 
            box-shadow: none !important;
        }
        /*Google Translate Effect*/
        #topNavbar{
            background: url(<?=base_url('assets/consult/images/header-hero.jpg')?>);
        }
        #topNavbar.homepage.bg-transparent{
            background:transparent;
        }
        #topNavbar.homepage.bg-transparent .nav-item a{
            color:#fff;
        }
        #topNavbar.homepage.bg-transparent #navbarSupportedContent{
            background: transparent;
        }
        #topNavbar.homepage.bg-transparent .navbar-toggler .toggler-icon{
            background-color: #fff;
        }

        @media screen and (max-width: 576px){
            .navbar-brand > img{
                width:65% !important;
            }
            a.navbar-brand{
                width: 80%;
            }
            nav.navbar{
                margin-top:10px;
                padding-right: 20px;
                padding-left: 20px;
            }
            .navbar-collapse{
                padding:5px 25px;
            }
        }
    </style>
</head>