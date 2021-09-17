<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'Keranjang',
            'morePackages'  =>  [
                'css'    =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css')
                ]
            ]
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarKontenItem   =   $this->path->uploadGambarKontenItem;
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="keranjang" class="service-area pt-150 pb-75">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h6 class="sub-title">
                                Keranjang
                                <span class="badge badge-success ml-1">#<?=$cartCode?></span>
                            </h6>
                            <h4 class="title">
                                <span>Belanjaan</span> kamu <span>nih</span>
                            </h4>
                        </div>
                    </div>
                </div> <!-- row -->
                <hr />
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class='border-top-0 text-center'>No.</th>
                                <th class='border-top-0 text-left'>Item</th>
                                <th class='border-top-0 text-right'>Harga</th>
                                <th class='border-top-0 text-right'>Quantity</th>
                                <th class='border-top-0 text-right'>Total Harga</th>
                                <th class='border-top-0 text-center'>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $isCartExist    =   false;
                                if(count($listKeranjang) >= 1){

                                    $isCartExist    =   true;

                                    $noUrut             =   1;
                                    $productExistCount  =   0;
                                    foreach($listKeranjang as $keranjang){
                                        $idKeranjang        =   $keranjang['id'];
                                        $idKontenItem       =   $keranjang['idKontenItem'];

                                        $detailKontenItemOptions    =   [
                                            'select'    =>  'foto, nama, rating, deskripsi'
                                        ];
                                        $detailKontenItem           =   $this->kontenItem->getKontenItem($idKontenItem, $detailKontenItemOptions);
                                        ?>
                                        <tr class='tr-parent' <?=($detailKontenItem === false)? 'style="opacity:.85;"' : ''?>>
                                            <?php 
                                                $nama       =   '';
                                                $quantity   =   0;
                                                if($detailKontenItem !== false){ 
                                                    $nama       =   $detailKontenItem['nama'];
                                                    $harga      =   $keranjang['harga'];
                                                    $diskon     =   $keranjang['diskon'];
                                                    $quantity   =   $keranjang['quantity'];

                                                    $hargaBersih    =   $harga - $diskon;
                                                    $isAnyDiskon    =   ($diskon >= 1);
                                                    $totalHarga     =   $hargaBersih * $quantity;

                                                    $productExistCount++;
                                            ?>
                                                <td class='text-center'><?=$noUrut?>.</td>
                                                <td class='text-left'>
                                                    <div class="row">
                                                        <img src="<?=base_url($uploadGambarKontenItem.'/compress/'.$detailKontenItem['foto'])?>" 
                                                            alt="<?=$nama?>" class='w-50-50 rounded-pill' />
                                                        <div class="col pl-3">
                                                            <h6 class='mb-1'><?=$nama?></h6>
                                                            <span class="text-sm">
                                                                <span class="lni lni-star-filled text-warning mr-1"></span>
                                                                <?=$detailKontenItem['rating']?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class='text-right'>
                                                    <h6 class='mb-1 text-success'>Rp. <?=number_format($hargaBersih)?></h6>
                                                    <?php if($isAnyDiskon){ ?>
                                                        <strike>Rp. <?=number_format($harga)?></strike>
                                                        <span class="text-muted text-sm">Diskon Rp.<?=number_format($diskon)?></span>
                                                    <?php } ?>
                                                </td>
                                                <td class='text-right quantity-parent'>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text cp" idKeranjang='<?=$idKeranjang?>' onClick='increment(this, 1)'>
                                                                <span class="lni lni-plus text-success"></span>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control text-center quantity"  value='<?=number_format($quantity)?>'
                                                            style='width:1.5rem;' onKeyup='quantityChanged(this)' idKeranjang='<?=$idKeranjang?>' />
                                                        <div class="input-group-append">
                                                            <span class="input-group-text cp" idKeranjang='<?=$idKeranjang?>' onClick='increment(this, -1)'>
                                                                <span class="lni lni-minus text-danger"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class='text-right total-harga'>
                                                    <b class="text-success">Rp. <?=number_format($totalHarga)?></b>
                                                </td>
                                                <td class='text-center'>
                                                    <span class="cp text-danger fa fa-trash hapus-item" id='<?=$idKeranjang?>'></span>
                                                </td>
                                            <?php }else{ ?>
                                                <td colspan='5' class='text-center'>
                                                    <h5 class='text-danger mb-1'>Item Belanjaan Tidak Ditemukan</h5>
                                                    <p class="text-sm mb-0 text-muted">Kemungkinan item yang anda pilih sebelumnya sudah dihapus dari sistem admin.</p>
                                                </td>
                                                <td class='text-center'>
                                                    <span class="cp text-danger fa fa-trash hapus-item" id='<?=$idKeranjang?>'></span>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
    
                                        $noUrut++;
                                    }
                                }else{
                                    ?>
                                        <tr>
                                            <td colspan='6' class='text-center'>
                                                <div class='py-4 text-center'>
                                                    <img src="<?=base_url('assets/img/empty.png')?>" alt="Tidak Ada Konten" style='width:150px; opacity:.25;' />
                                                    <p class="text-sm text-muted mb-0">Tidak ada produk di dalam keranjang anda, yuk belanja!</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php if($isCartExist && $productExistCount >= 1){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="service-btn text-center pt-25 pb-15">
                                <button class="main-btn main-btn-2" id="btnCheckout">Checkout</a>
                            </div> <!-- service btn -->
                        </div>
                    </div>
                <?php } ?>
            </div> <!-- container -->
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php 
            $javascriptOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/myJS/delayKeyup.js')
                    ]
                ]
            ];
            $this->load->view(websiteComp('javascript'), $javascriptOptions); 
        ?>
    </body>
</html>
<script language='Javascript'>
    $('.hapus-item').on('click', async function(e){
        e.preventDefault();

        let _idKeranjang    =   $(this).attr('id');

        let _title      =   'Konfirmasi Hapus';
        let _message    =   'Apakah anda yakin akan menghapus item ini dari keranjang?';
        let _confirm    =   await confirmSwal(_title, _message);

        if(_confirm){
            $.ajax({
                url     :   '<?=site_url('keranjang/process_delete')?>',
                data    :   `idKeranjang=${_idKeranjang}`,
                type    :   'POST',
                success     :   function(decodedRFS){
                    let _statusDeleteCart   =   decodedRFS.statusDeleteCart;

                    if(_statusDeleteCart){
                        location.reload();
                    }else{
                        let _message        =   decodedRFS.message;
                        let _htmlMessage    =   `Gagal menghapus keranjang, silahkan coba lagi! ${_message}`;

                        notificationSwal('Hapus Keranjang', _htmlMessage, 'error', null);
                    }
                }
            });
        }
    });
    $('#btnCheckout').on('click', function(e){
        e.preventDefault();
        let _cartCode   =   '<?=$cartCode?>';

        let _el         =   $(this);
        let _btnText    =   _el.text();

        _el.prop('disabled', true).text('Processing ...');       

        $.ajax({
            url     :   '<?=site_url('keranjang/process_checkout')?>',
            data    :   `cartCode=${_cartCode}`,
            type    :   'POST',
            success :   function(decodedRFS){
                _el.prop('disabled', false).text(_btnText);  

                let _statusCheckout     =   decodedRFS.statusCheckout;
                if(_statusCheckout){
                    let _data       =   decodedRFS.data;
                    let _linkWA     =   _data.linkWhatsapp;

                    location.href   =   _linkWA;
                }else{
                    let _message        =   decodedRFS.message;
                    let _htmlMessage    =   `Gagal checkout, silahkan coba lagi! ${_message}`;

                    notificationSwal('Checkout', _htmlMessage, 'error', null);
                }                
            }
        });
    });
    function increment(thisContext, quantity, changeToThisQuantity = false){
        let _el             =   $(thisContext);
        let idKeranjang     =   _el.attr('idKeranjang');

        let _quantityParent =   _el.parents('.quantity-parent');
        let _quantityForm   =   _quantityParent.find('.quantity');

        let _trParent   =   _el.parents('.tr-parent');
        let _totalHarga =   _trParent.find('.total-harga');

        $.ajax({
            url     :   `<?=site_url('keranjang/process_increment')?>`,
            data    :   `quantity=${quantity}&changeToThisQuantity=${changeToThisQuantity}&idKeranjang=${idKeranjang}`,
            type    :   'POST',
            success     :   function(decodedRFS){
                let _statusIncrement     =   decodedRFS.statusIncrement;
                if(_statusIncrement){
                    let _audio  =   new Audio('<?=base_url('assets/sounds/bell.mp3')?>');
                    _audio.play();

                    let _currentQuantity    =   decodedRFS.currentQuantity;
                    let _currentTotalHarga  =   decodedRFS.currentTotalHarga;

                    _quantityForm.val(_currentQuantity);
                    _totalHarga.html(`<b class="text-success">${_currentTotalHarga}</b>`);
                }else{
                    let _message        =   decodedRFS.message;
                    let _htmlMessage    =   `Gagal menambah/mengurangi nilai, silahkan coba lagi! ${_message}`;

                    notificationSwal('Quantity', _htmlMessage, 'error', null);
                }  
            }
        });
    }
    function quantityChanged(thisContext){
        let _el     =   $(thisContext);
        let _value  =   _el.val();

        delay(() => {
            increment(thisContext, _value, true);
        }, 650);
    }
</script>