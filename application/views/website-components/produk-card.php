<?php 
    $idKontenItem   =   $kontenItem['id'];
    $harga          =   $kontenItem['harga'];
    $diskon         =   $kontenItem['diskon'];

    $hargaBersih    =   $harga - $diskon;
    $isAnyDiskon    =   ($diskon >= 1);
?>
<div class="produk-card card shadow" style='overflow:hidden;'>
    <div class="col px-0 py-3 produk-img text-center">
        <img src="<?=base_url($uploadGambarKontenItem.'/compress/'.$kontenItem['foto'])?>" alt="<?=$kontenItem['nama']?>" 
             class='d-inline-block <?=(strtolower($kontenItem['foto']) !== $this->defaultimage->kontenItem)? 'shadow' : ''?>' />
        <?php 
            if($isAnyDiskon){
                $persentaseDiskon   =   $diskon / $hargaBersih * 100;
        ?>
            <span class="badge badge-warning badge-diskon shadow">FREE <?=number_format($persentaseDiskon, 2)?>%</span>
        <?php } ?>
    </div>
    <div class="col text-center pt-3 pb-4">
        <h4 class='mb-2'><?=$kontenItem['nama']?></h4>
        <div class='text-center rating'>
            <?php 
                for($i = 1; $i >= 5; $i++){ 
                    if($i <= $kontenItem['rating']){
                        $ratingClassName  =   'lni lni-star-filled text-warning produk-rating';
                    }else{
                        $ratingClassName  =   'lni lni-star-filled produk-rating';
                    }
                    ?>
                    <span class="<?=$ratingClassName?>"></span>
                    <?php
                }
            ?>
        </div>
        <br />
        <h4 class='text-success mb-1'>Rp. <?=number_format($hargaBersih)?></h4>
        <?php if($isAnyDiskon){ ?>
            <strike><h6 class='text-muted'>Rp. <?=number_format($harga)?></h6></strike>
        <?php } ?>
        <br />
        <button class="btn btn-success btn-block rounded-pill shadow btn-beli" id='<?=$idKontenItem?>'>
            <span class="lni lni-cart mr-2"></span>
            Beli
        </button>
    </div>
</div>