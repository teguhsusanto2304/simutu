<?php 
    $currentController      =   $this->uri->segment(1);
    $currentControllerLC    =   strtolower($currentController);
    
    $currentFunction    =   $this->uri->segment(2);
    if($currentFunction == ''){
        $currentFunction    =   'Index';
    }
    $currentFunctionLC  =   strtolower($currentFunction);

    if(!isset($pageName)){
        $pageName   =   'Unknow Page Name';
    }
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?=$pageName?></h1>
                <?php if(isset($pageNameSubTitle)){ ?>
                    <span class="text-muted text-sm"><?=$pageNameSubTitle?></span>
                <?php } ?>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?=site_url($currentControllerLC)?>">
                            <?=$currentController?>
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href='<?=site_url($currentControllerLC.'/'.$currentFunctionLC)?>'>
                            <?=$currentFunction?>
                        </a>
                    </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->