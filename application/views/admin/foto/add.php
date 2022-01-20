<?php
    $cF     =   $this->cF;

    $listFotoHTML   =   '<a href="'.site_url(adminControllers('foto')).'">
                            <button class="btn btn-link btn-sm">List Foto</button>
                        </a>';

    $dGS    =   isset($detailGaleri);
    if($dGS){
        $dG     =   $detailGaleri;
        
        $listFotoHTML   =   '<a href="'.site_url(adminControllers('galeri/foto/'.$dG['id'])).'">
                                <button class="btn btn-link btn-sm">List Foto Galeri <b>'.$dG['judul'].'</b></button>
                            </a>';
    }

    if(!$dGS){
        function galeriGenerator($galeri){
            return  ['text' => $galeri['judul'], 'value' => $galeri['id']];
        }
        $galeriItems    =   array_map('galeriGenerator', $listGaleri);

        $galeriParams    =   [
            'items'         =>  $galeriItems,
            'id'            =>  'idGaleri',
            'name'          =>  'idGaleri',
            'defaultOptionText'     =>  'Pilih Galeri',
            'defaultOptionValue'    =>  ''
        ];
    }

    $namaParams    =   [
        'id'            =>  'nama',
        'name'          =>  'nama',
        'placeholder'   =>  'Nama Foto'
    ];

    if($detailFoto !== false){
        $namaParams['value']            =   $detailFoto['nama'];

        if(!$dGS){
            $galeriParams['selectedValue']  =   $detailFoto['idGaleri'];
        }
    }

    $uploadGambarGaleri   =   $this->path->uploadGambarGaleri;
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css')
                ]
            ]
        ];
        $this->load->view(adminComponents('head'), $headOptions); 
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php $this->load->view(adminComponents('preloader')); ?>            

            <?php $this->load->view(adminComponents('navbar')); ?>
            <?php $this->load->view(adminComponents('sidebar')); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php 
                    $contentHeaderOptions   =   ['pageName' => ($detailFoto !== false)? 'Edit Foto' : 'Add New Foto'];
                    if($dGS){
                        $contentHeaderOptions['pageNameSubTitle']   =   'Galeri <b>'.$dG['judul'].'</b>';
                    }
                    if($detailFoto !== false){
                        $contentHeaderOptions['pageNameSubTitle']   =   'Foto <b>'.$detailFoto['nama'].'</b>';
                    }
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <?php if($dGS){ ?>
                                                <img src='<?=base_url($uploadGambarGaleri.'/compress/'.$dG['foto'])?>' alt='<?=$dG['judul']?>' 
                                                    class='img-circle w-50-50' />
                                            <?php } ?>
                                            <div class="col <?=($dGS)? 'pl-3' : ''?>">
                                                <h5 class='mb-0'><?=($detailFoto !== false)? 'Edit Foto' : 'Foto Baru'?></h5>
                                                <?php 
                                                    if($dGS){
                                                        echo    '<span class="text-muted text-sm">Galeri <b>'.$dG['judul'].'</b></span>';
                                                    }
                                                    if($detailFoto !== false){
                                                        echo    '<span class="text-muted text-sm">Galeri <b>'.$detailFoto['nama'].'</b></span>';
                                                    }
                                                ?>
                                            </div>
                                            <div class="col text-right">
                                                <?=$listFotoHTML?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formFoto">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='fotoImage'>
                                                        <img src="<?=base_url(($detailFoto !== false)? $path->uploadGambarFoto.'/'.$detailFoto['foto'] : 'assets/img/upload-icon.png')?>" 
                                                            alt="Gambar Foto" 
                                                            class='w-100 cp <?=($detailFoto !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' id='imgPreview' />
                                                        <input type="file" id='fotoImage' onChange='imgChanged(this)'
                                                            style='display:none;' name='fotoImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 1920px x 1080px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <?php if(!$dGS){ ?>
                                                            <div class="form-group col-lg-5">
                                                                <?=$cF->selectBox($galeriParams, 'Galeri Tujuan')?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="form-group col-lg-<?=(!$dGS)? '7' : '12'?>">
                                                            <?=$cF->textField($namaParams, 'Nama Foto')?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="keterangan" class='label-title'>Keterangan</label>
                                                        <textarea class="form-control input" name='keterangan'
                                                            placeholder='Keterangan Foto'
                                                            id='keterangan'><?=($detailFoto !== false)? $detailFoto['keterangan'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailFoto !== false)? 'Perubahan' : ''?> Data Foto</button>
                                                    <a href="<?=site_url(adminControllers('foto'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Foto</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.content-wrapper -->

            <?php $this->load->view(adminComponents('footer')); ?>
        </div>

        <?php 
            $jsOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<script language='Javascript'>
    let baseURL             =   '<?=base_url()?>';

    let imgPreview  =   false;
    let imgData     =   false;

    let idFoto    =   '<?=($detailFoto !== false)? '/'.$detailFoto['id'] : ''?>';

    let _dGS    =   '<?=$dGS?>';
    _dGS        =   (_dGS == true);
    
    function imgChanged(thisContext){
        try{
            let el          =   $(thisContext);
            let _imgData     =   el.prop('files')[0];

            let fileReader  =   new FileReader();
            fileReader.readAsDataURL(_imgData);
            fileReader.onload   =   (e) =>  {
                let imgResult   =   e.target.result;
                imgPreview    =   imgResult;
                imgData       =   _imgData;

                $('#imgPreview').attr('src', imgPreview).addClass('img-thumbnail');
            }
        }catch(e){
            console.log(e);
        }
    }

    $('#formFoto').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        if(imgData !== false){
            _formData.append('foto', imgData);
        }

        let _galeriTujuan   =   (_dGS)? '<?=($dGS)? $dG['id'] : ''?>' : $('#idGaleri').val();

        _formData.append('idGaleri', _galeriTujuan);
        _formData.append('nama', $('#nama').val());
        _formData.append('keterangan', $('#keterangan').val());
 
        $.ajax({
            url     :   `<?=site_url(adminControllers('foto/process_save'))?>${idFoto}`,
            type    :   'POST',
            data    :   _formData,
            processData :   false,
            contentType :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave     =   _decodedRFS.statusSave;

                let _swalType, _swalMessage, _onClick;
                if(_statusSave){
                    _swalMessage    =   'Berhasil menyimpan data foto!';
                    _swalType       =   'success';
                    _onClick        =   () => {location.href   =   `<?=site_url(adminControllers('galeri/foto/'))?>${_galeriTujuan}`;};
                }else{
                    _swalMessage    =   'Gagal menyimpan data foto!';
                    _swalType       =   'error';
                    _onClick        =   null;
                }

                notificationSwal('Foto', _swalMessage, _swalType, _onClick);
            }
        });
    });
</script>