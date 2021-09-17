<?php 
    $cF =   $this->cF;

    $idKonten       =   $detailKonten['id'];
    $namaDivisi     =   $detailKonten['namaDivisi'];

    $namaParams     =   ['placeholder' => 'Nama Konten', 'name' => 'nama', 'id' => 'nama'];
    $ratingParams   =   ['placeholder' => 'Rating', 'name' => 'rating', 'id' => 'rating', 'type' => 'number'];
    $hargaParams    =   ['placeholder' => 'Harga', 'name' => 'harga', 'id' => 'harga', 'type' => 'number'];
    $diskonParams   =   [
        'placeholder'   =>  'Diskon',
        'name'          =>  'diskon',
        'id'            =>  'diskon',
        'type'          =>  'number',
        'value'         =>  0
    ];

    if($detailKontenItem !== false){
        $namaParams['value']    =   $detailKontenItem['nama'];
        $ratingParams['value']  =   $detailKontenItem['rating'];
        $hargaParams['value']   =   $detailKontenItem['harga'];
        $diskonParams['value']  =   $detailKontenItem['diskon'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions  =   [
            'pageTitle'     =>  $pageName,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css')
                ]
            ]  
        ];
        $this->load->view(adminComponents('head'), $headOptions); 
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <!-- wrapper -->
        <div class="wrapper">
            <?php $this->load->view(adminComponents('preloader')); ?>
            <?php $this->load->view(adminComponents('navbar')); ?>
            <?php $this->load->view(adminComponents('sidebar')); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php
                    $contentHeaderOptions   =   [
                        'pageName'          =>  ($detailKontenItem !== false)? 'Edit Data Konten Item' : 'Add New Konten Item',
                        'pageNameSubTitle'  =>  $namaDivisi
                    ]; 

                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5><?=($detailKontenItem !== false)? 'Edit Data Konten Item' : 'Konten Item Baru'?></h5>
                                                <?php if($detailKontenItem !== false){ ?>
                                                    <p class='mb-0 text-muted text-sm'><?=strtoupper($detailKontenItem['nama'])?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formKontenItem">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='kontenItemImg'>
                                                        <img src="<?=base_url(($detailKontenItem !== false)? $this->path->uploadGambarKontenItem.'/'.$detailKontenItem['foto'] : 'assets/img/upload-icon.png')?>" 
                                                            alt="Foto Konten Item" id='kontenItemImgPreview'
                                                            class='w-100 cp <?=($detailKontenItem !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' />
                                                        <input type="file" id='kontenItemImg' onChange='kontenItemImgChanged(this, event)'
                                                            style='display:none;' name='kontenItemImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 700px x 700px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($namaParams, 'Nama Konten')?>
                                                        </div>
                                                        <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($ratingParams, 'Rating (1 s/d 5)')?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($hargaParams, 'Harga')?>
                                                        </div>
                                                        <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($diskonParams, 'Diskon')?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi" class='label-title'>Deskripsi</label>
                                                        <textarea class="form-control input" name='deskripsi' id='deskripsi' required
                                                            placeholder='Deskripsi'><?=($detailKontenItem !== false)? $detailKontenItem['deskripsi'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit' id='btnSubmit'>
                                                            Simpan <?=($detailKontenItem !== false)? 'Perubahan' : ''?> Data Konten Item
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- /.content -->
            </div>

            <?php $this->load->view(adminComponents('footer')); ?>
        </div>
        <!-- ./wrapper -->
        <?php 
            $javascriptOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $javascriptOptions); 
        ?>
    </body>
</html>


<script language='Javascript'>
    let baseURL                 =   '<?=base_url()?>';
    let adminControllers        =   '<?=adminControllers()?>';
    let _isUpdateKontenItem     =   '<?=($detailKontenItem !== false)? 'true' : 'false'?>';
    _isUpdateKontenItem         =   (_isUpdateKontenItem === 'true');

    let _idKonten               =   '<?=($idKonten)?>';
    let _idKontenItem           =   '<?=($detailKontenItem !== false)? '/'.$detailKontenItem['id'] : '' ?>';

    let kontenItemImgPreview    =   false;
    let kontenItemImgData       =   false;

    $('#formKontenItem').on('submit', function(e){
        e.preventDefault();
        
        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();

        _btnSubmit.prop('disabled', true).text('Processing ..');

        let _dataKontenItem   =   new FormData();

        _dataKontenItem.append('foto', kontenItemImgData);
        _dataKontenItem.append('nama', $('#nama').val());
        _dataKontenItem.append('rating', $('#rating').val());
        _dataKontenItem.append('harga', $('#harga').val());
        _dataKontenItem.append('diskon', $('#diskon').val());
        _dataKontenItem.append('deskripsi', $('#deskripsi').val());
        _dataKontenItem.append('idKonten', _idKonten);

        $.ajax({
            url     :   `${baseURL}/${adminControllers}/kontenItem/process_save${_idKontenItem}`,
            data    :   _dataKontenItem,
            type    :   'POST',
            processData     :   false,
            contentType     :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                let _statusSave     =   _decodedRFS.statusSave;

                let _title      =   'Konten Item';
                let _action     =   (_isUpdateKontenItem)? 'Mengedit' : 'Menambah';
                   
                let _message, _type, _onClick;
                if(_statusSave){
                    _onClick    =   () => location.href = '<?=base_url(adminControllers('konten/detail/'.$idKonten))?>';
                    _type       =   'success';
                    _message    =   `<span class='text-success'>Berhasil ${_action} Data Konten Item!</span>`;
                }else{
                    _onClick    =   null;
                    _type       =   'error';
                    _message    =   `<span class='text-danger'>Gagal ${_action} Data Konten Item! <br /> ${_decodedRFS.message}`;
                }

                _btnSubmit.prop('disabled', false).text(_btnSubmitText);
                notificationSwal(_title, _message, _type, _onClick);
            }
        });
    });

    function kontenItemImgChanged(thisContext){
        let el          =   $(thisContext);
        let imgData     =   el.prop('files')[0];

        let fileReader  =   new FileReader();
        fileReader.readAsDataURL(imgData);
        fileReader.onload   =   (e) =>  {
            let imgResult   =   e.target.result;
            kontenItemImgPreview    =   imgResult;
            kontenItemImgData       =   imgData;

            $('#kontenItemImgPreview').attr('src', kontenItemImgPreview).addClass('img-thumbnail');
        }
    }
</script>