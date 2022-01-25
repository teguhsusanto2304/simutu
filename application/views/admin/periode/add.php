<?php
    $cF     =   $this->cF;

    $tahunParams    =   [
        'id'    =>  'tahunPeriode',
        'type'  =>  'number',
        'name'  =>  'tahunPeriode',
        'placeholder'   =>  'Tahun Periode'
    ];
    $namaParams    =   [
        'id'    =>  'namaPeriode',
        'name'  =>  'namaPeriode',
        'placeholder'   =>  'Nama Periode'
    ];
    $mulaiPelaksanaanParams    =   [
        'type'  =>  'date',
        'id'    =>  'mulaiPelaksanaan',
        'name'  =>  'mulaiPelaksanaan',
        'placeholder'   =>  'Mulai Pelaksanaan'
    ];
    $akhirPelaksanaanParams    =   [
        'type'  =>  'date',
        'id'    =>  'akhirPelaksanaan',
        'name'  =>  'akhirPelaksanaan',
        'placeholder'   =>  'Akhir Pelaksanaan'
    ];
    $mulaiPenilaianParams    =   [
        'type'  =>  'date',
        'id'    =>  'mulaiPenilaian',
        'name'  =>  'mulaiPenilaian',
        'placeholder'   =>  'Mulai Penilaian'
    ];
    $akhirPenilaianParams    =   [
        'type'  =>  'date',
        'id'    =>  'akhirPenilaian',
        'name'  =>  'akhirPenilaian',
        'placeholder'   =>  'Akhir Penilaian'
    ];

    if($detailPeriode !== false){
        $tahunParams['value']   =   $detailPeriode['tahunPeriode'];
        $namaParams['value']   =   $detailPeriode['namaPeriode'];
        $mulaiPelaksanaanParams['value']   =   $detailPeriode['mulaiPelaksanaan'];
        $akhirPelaksanaanParams['value']   =   $detailPeriode['akhirPelaksanaan'];
        $mulaiPenilaianParams['value']   =   $detailPeriode['mulaiPenilaian'];
        $akhirPenilaianParams['value']   =   $detailPeriode['akhirPenilaian'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css'),
                    base_url('assets/plugins/select2/css/select2.min.css'),
                    base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css')
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
                    $contentHeaderOptions   =   ['pageName' => 'Periode'];
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
                                                <h5><?=($detailPeriode !== false)? 'Edit Periode' : 'Periode Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('periode'))?>">
                                                    <button class="btn btn-link btn-sm">List Periode</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formStandart">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->textField($tahunParams, 'Tahun Periode')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Periode')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($mulaiPelaksanaanParams, 'Mulai Pelaksanaan')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($akhirPelaksanaanParams, 'Akhir Pelaksanaan')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($mulaiPenilaianParams, 'Mulai Penilaian')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($akhirPenilaianParams, 'Akhir Penilaian')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailPeriode !== false)? 'Perubahan' : ''?> Data Periode</button>
                                                    <a href="<?=site_url(adminControllers('periode'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Periode</button>
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
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/select2/js/select2.js')
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

    let idPeriode      =   '<?=($detailPeriode !== false)? '/'.$detailPeriode['idPeriode'] : ''?>';

    $('#standart').select2({
        theme   :   'bootstrap4'
    });    

    $('#formStandart').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('tahunPeriode', $('#tahunPeriode').val());
        _formData.append('namaPeriode', $('#namaPeriode').val());
        _formData.append('mulaiPelaksanaan', $('#mulaiPelaksanaan').val());
        _formData.append('akhirPelaksanaan', $('#akhirPelaksanaan').val());
        _formData.append('mulaiPenilaian', $('#mulaiPenilaian').val());
        _formData.append('akhirPenilaian', $('#akhirPenilaian').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('periode/process_save'))?>${idPeriode}`,
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
                    _swalMessage    =   'Berhasil menyimpan data Periode!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan data Periode! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Periode',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('periode'))?>`;
                    }
                });
            }
        });
    });
</script>