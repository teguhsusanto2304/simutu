<?php
    $cF     =   $this->cF;

    $kodeParams    =   [
        'id'    =>  'kodeIndikator',
        'name'  =>  'kodeIndikator',
        'placeholder'   =>  'Kode Indikator'
    ];
    $namaParams    =   [
        'id'    =>  'namaIndikator',
        'name'  =>  'namaIndikator',
        'placeholder'   =>  'Nama Indikator'
    ];

    $listPernyataan       =   $this->pernyataan->getPernyataan(null, ['select' => 'kodePernyataan, namaPernyataan']);

    function listPernyataanItemsGenerator($pernyataan){
        return  ['text' => $pernyataan['namaPernyataan'], 'value' => $pernyataan['kodePernyataan']];
    }
    $listPernyataanItems  =   array_map('listPernyataanItemsGenerator', $listPernyataan);

    $pernyataanParams    =   [
        'id'    =>  'pernyataan',
        'name'  =>  'pernyataan',
        'items' =>  $listPernyataanItems,
        'defaultOptionText'     =>  'Pilihan Pernyataan',
        'defaultOptionValue'    =>  ''
    ];

    if($detailIndikator !== false){
        $kodeParams['value']   =   $detailIndikator['kodeIndikator'];
        $namaParams['value']   =   $detailIndikator['namaIndikator'];
        $pernyataanParams['selectedValue']    =   $detailIndikator['kodePernyataan'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Indikator'];
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
                                                <h5><?=($detailIndikator !== false)? 'Edit Indikator' : 'Indikator Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/Indikator'))?>">
                                                    <button class="btn btn-link btn-sm">List Indikator</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formIndikator">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->selectBox($pernyataanParams, 'Pernyataan')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($kodeParams, 'Kode Indikator')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Indikator')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailIndikator !== false)? 'Perubahan' : ''?> Data Indikator</button>
                                                    <a href="<?=site_url(adminControllers('spmi/Indikator'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Indikator</button>
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

    let idIndikator      =   '<?=($detailIndikator !== false)? '/'.$detailIndikator['indikatorId'] : ''?>';

    $('#pernyataan').select2({
        theme   :   'bootstrap4'
    });    

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

    $('#formIndikator').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('kodeIndikator', $('#kodeIndikator').val());
        _formData.append('namaIndikator', $('#namaIndikator').val());
        _formData.append('pernyataan', $('#pernyataan').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/Indikator/process_save'))?>${idIndikator}`,
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
                    _swalMessage    =   'Berhasil menyimpan data Indikator!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan data Indikator! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Indikator',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/Indikator'))?>`;
                    }
                });
            }
        });
    });
</script>