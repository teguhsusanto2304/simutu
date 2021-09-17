<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$pageTitle?> | User (Mahasiswa dan Dosen)</title>

    <link rel="stylesheet" href="<?=base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/')?>dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?=base_url('assets/img/magang-icon.png')?>" />
    
    <style type="text/css">
        .nav-treeview > .nav-item > .nav-link{
            font-size: .875rem;
            padding-left: 2rem;
        }
        .user-profile-img{
            width:3.25rem !important;
        }
        .cp{
            cursor: pointer;
        }
        .w-50-50{
            width:50px;
            height:50px;
        }
        .w-25-25{
            width:25px;
            height:25px;
        }
    </style>
    <?php 
        if(isset($morePackages)){
            if(is_array($morePackages)){
                if(array_key_exists('css', $morePackages)){
                    $moreCSSPackages    =   $morePackages['css'];

                    if(count($moreCSSPackages) >= 1){
                        foreach($moreCSSPackages as $moreCSS){
                            ?>    
                                <link rel="stylesheet" href="<?=$moreCSS?>" />
                            <?php
                        }
                    }
                }
            }
        }
    ?>
</head>