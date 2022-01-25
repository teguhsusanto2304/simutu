<?php
    $cF     =   $this->cF;

    $kodeParams    =   [
        'id'    =>  'kodePernyataan',
        'name'  =>  'kodePernyataan',
        'placeholder'   =>  'Kode Pernyataan'
    ];
    $namaParams    =   [
        'id'    =>  'namaPernyataan',
        'name'  =>  'namaPernyataan',
        'placeholder'   =>  'Nama Pernyataan'
    ];

    $listSubStandart       =   $this->subStandart->getSubStandart(null, ['select' => 'kodeSubStandar, namaSubStandar']);

    function listSubStandartItemsGenerator($subStandart){
        return  ['text' => $subStandart['namaSubStandar'], 'value' => $subStandart['kodeSubStandar']];
    }
    $listSubStandartItems  =   array_map('listSubStandartItemsGenerator', $listSubStandart);

    $subStandartParams    =   [
        'id'    =>  'subStandart',
        'name'  =>  'subStandart',
        'items' =>  $listSubStandartItems,
        'defaultOptionText'     =>  'Pilihan Sub Standart',
        'defaultOptionValue'    =>  ''
    ];

    if($detailPernyataan !== false){
        $kodeParams['value']   =   $detailPernyataan['kodePernyataan'];
        $namaParams['value']   =   $detailPernyataan['namaPernyataan'];
        $subStandartParams['selectedValue']    =   $detailPernyataan['kodeSubStandar'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Penyataan'];
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
                                                <h5><?=($detailPernyataan !== false)? 'Edit Penyataan' : 'Penyataan Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/Pernyataan'))?>">
                                                    <button class="btn btn-link btn-sm">List Penyataan</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formPernyataan">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->selectBox($subStandartParams, 'Sub Standart')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($kodeParams, 'Kode Pernyataan')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Pernyataan')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailPernyataan !== false)? 'Perubahan' : ''?> Data Pernyataan</button>
                                                    <a href="<?=site_url(adminControllers('spmi/Pernyataan'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Pernyataan</button>
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

    let imgPreview  =   false;
    let imgData     =   false;

    let idPernyataan      =   '<?=($detailPernyataan !== false)? '/'.$detailPernyataan['pernyataanId'] : ''?>';

    $('#subStandart').select2({
        theme   :   'bootstrap4'
    });    

    $('#formPernyataan').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('kodeSubStandar', $('#subStandart').val());
        _formData.append('kodePernyataan', $('#kodePernyataan').val());
        _formData.append('namaPernyataan', $('#namaPernyataan').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/Pernyataan/process_save'))?>${idPernyataan}`,
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
                    _swalMessage    =   'Berhasil menyimpan data Pernyataan!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan data Pernyataan! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Pernyataan',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/Pernyataan'))?>`;
                    }
                });
            }
        });
    });
</script>