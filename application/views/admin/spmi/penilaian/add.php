<?php
    $cF     =   $this->cF;

    $namaParams    =   [
        'id'    =>  'namaPenilaian',
        'name'  =>  'namaPenilaian',
        'placeholder'   =>  'nama Penilaian'
    ];
     $warnaParams    =   [
        'id'    =>  'warna',
        'name'  =>  'warna',
        'placeholder'   =>  'Warnah Penilaian'
    ];
     $bobotParams    =   [
        'id'    =>  'bobot',
        'name'  =>  'bobot',
        'placeholder'   =>  'Skor Penilaian'
    ];

    if($detailPenilaian !== false){
        $namaParams['value']   =   $detailPenilaian['namaPenilaian'];
        $warnaParams['value']   =   $detailPenilaian['warna'];
        $bobotParams['value']   =   $detailPenilaian['bobot'];
    }
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
                    $contentHeaderOptions   =   ['pageName' => 'Penilaian'];
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <h5><?=($detailPenilaian !== false)? 'Edit Penilaian' : 'Tambah Penilaian'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/Penilaian'))?>">
                                                    <button class="btn btn-link btn-sm">List Penilaian</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formPenilaian">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Penilaian')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($warnaParams, 'Warnah Penilaian')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($bobotParams, 'Skor Penilaian')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailPenilaian !== false)? 'Perubahan' : ''?> Data Penilaian</button>
                                                    <a href="<?=site_url(adminControllers('spmi/Penilaian'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Standart</button>
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
<script src="<?=base_url('assets/plugins/ckfinder_php_3.5.2/ckfinder/ckfinder.js')?>"></script>
<script language='Javascript'>
    let baseURL             =   '<?=base_url()?>';

    let imgPreview  =   false;
    let imgData     =   false;

    let idPenilaian      =   '<?=($detailPenilaian !== false)? '/'.$detailPenilaian['idPenilaian'] : ''?>';

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

    $('#formPenilaian').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('namaPenilaian', $('#namaPenilaian').val());
        _formData.append('warna', $('#warna').val());
        _formData.append('bobot', $('#bobot').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/Penilaian/process_save'))?>${idPenilaian}`,
            type    :   'POST',
            data    :   _formData,
            processData :   false,
            contentType :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave     =   _decodedRFS.statusSave;

                let _swalType, _swalMessage;

                if(_statusSave){
                    _swalMessage    =   'Berhasil menyimpan data Penilaian!';
                    _swalType       =   'success';
                }else{
                    _swalMessage    =   'Gagal menyimpan data Penilaian!';
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Penilaian',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/Penilaian'))?>`;
                    }
                });
            }
        });
    });
</script>