<?php
    $cF     =   $this->cF;

   
    $namaParams    =   [
        'id'    =>  'namaIndikatorDokumen',
        'name'  =>  'namaIndikatorDokumen',
        'placeholder'   =>  'Nama Indikator Dokumen'
    ];

    $listIndikator       =   $this->indikator->getIndikator(null, ['select' => 'kodeIndikator, namaIndikator']);

    function listIndikatorItemsGenerator($indikator){
        return  ['text' => $indikator['namaIndikator'], 'value' => $indikator['kodeIndikator']];
    }
    $listIndikatorItems  =   array_map('listIndikatorItemsGenerator', $listIndikator);

    $indikatorParams    =   [
        'id'    =>  'indikator',
        'name'  =>  'indikator',
        'items' =>  $listIndikatorItems,
        'defaultOptionText'     =>  'Pilihan Indikator',
        'defaultOptionValue'    =>  ''
    ];

    if($detailIndikatorDokumen !== false){
        $namaParams['value']   =   $detailIndikatorDokumen['namaIndikatorDokumen'];
        $indikatorParams['selectedValue']    =   $detailIndikatorDokumen['kodeIndikator'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Indikator Dokumen'];
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
                                                <h5><?=($detailIndikatorDokumen !== false)? 'Edit Indikator Dokumen' : 'Indikator Dokumen Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/IndikatorDokumen'))?>">
                                                    <button class="btn btn-link btn-sm">List Indikator Dokumen</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formIndikatorDokumen">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->selectBox($indikatorParams, 'Indikator')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Indikator Dokumen')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailIndikatorDokumen !== false)? 'Perubahan' : ''?> Data Indikator Dokumen</button>
                                                    <a href="<?=site_url(adminControllers('spmi/IndikatorDokumen'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Indikator Dokumen</button>
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

    let idIndikator      =   '<?=($detailIndikatorDokumen !== false)? '/'.$detailIndikatorDokumen['indikatorDokumenId'] : ''?>';

    $('#indikator').select2({
        theme   :   'bootstrap4'
    });    

     $('#formIndikatorDokumen').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('namaIndikatorDokumen', $('#namaIndikatorDokumen').val());
        _formData.append('indikator', $('#indikator').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/IndikatorDokumen/process_save'))?>${idIndikator}`,
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
                    _swalMessage    =   'Berhasil menyimpan data Indikator Dokumen!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan data Indikator Dokumen! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Indikator Dokumen',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/IndikatorDokumen'))?>`;
                    }
                });
            }
        });
    });
</script>