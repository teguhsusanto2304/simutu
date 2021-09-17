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
        .coming-soon{
            opacity: 0.5;
        }
        .w-50-50{
            width:50px;
            height:50px;
        }
        .w-25-25{
            width:25px;
            height:25px;
        }
        .cp{
            cursor: pointer;
        }
    </style>
</head>