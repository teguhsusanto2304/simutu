<?php
    $cF     =   $this->cF;

    $kodeParams    =   [
        'id'    =>  'kodeSubStandar',
        'name'  =>  'kodeSubStandar',
        'placeholder'   =>  'Kode Standart'
    ];
    $namaParams    =   [
        'id'    =>  'namaSubStandar',
        'name'  =>  'namaSubStandar',
        'placeholder'   =>  'Nama Standart'
    ];
    $linkParams    =   [
        'id'    =>  'linkSubStandar',
        'name'  =>  'linkSubStandar',
        'placeholder'   =>  'Link Standart'
    ];

    $listStandart       =   $this->standart->getStandart(null, ['select' => 'kodeStandar, namaStandar']);

    function listStandartItemsGenerator($standart){
        return  ['text' => $standart['namaStandar'], 'value' => $standart['kodeStandar']];
    }
    $listStandartItems  =   array_map('listStandartItemsGenerator', $listStandart);

    $standartParams    =   [
        'id'    =>  'standart',
        'name'  =>  'standart',
        'items' =>  $listStandartItems,
        'defaultOptionText'     =>  'Pilihan Standart',
        'defaultOptionValue'    =>  ''
    ];

    if($detailSubStandart !== false){
        $kodeParams['value']   =   $detailSubStandart['kodeSubStandar'];
        $namaParams['value']   =   $detailSubStandart['namaSubStandar'];
        $linkParams['value']   =   $detailSubStandart['linkStandarSPMI'];
        $standartParams['selectedValue']    =   $detailSubStandart['kodeStandar'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Sub Standart'];
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
                                                <h5><?=($detailSubStandart !== false)? 'Edit Sub Standart' : 'Sub Standart Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/SubStandart'))?>">
                                                    <button class="btn btn-link btn-sm">List Sub Standart</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formStandart">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->textField($kodeParams, 'Kode Sub Standart')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->selectBox($standartParams, 'Nama Standart')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Sub Standart')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($linkParams, 'Contoh Link Sub Standart')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailSubStandart !== false)? 'Perubahan' : ''?> Data Sub Standart</button>
                                                    <a href="<?=site_url(adminControllers('spmi/SubStandart'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Sub Standart</button>
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

    let idSubStandart      =   '<?=($detailSubStandart !== false)? '/'.$detailSubStandart['subStandarId'] : ''?>';

    $('#standart').select2({
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

    $('#formStandart').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _formData   =   new FormData();
        _formData.append('kodeStandar', $('#standart').val());
        _formData.append('kodeSubStandar', $('#kodeSubStandar').val());
        _formData.append('namaSubStandar', $('#namaSubStandar').val());
        _formData.append('linkSubStandar', $('#linkSubStandar').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/SubStandart/process_save'))?>${idSubStandart}`,
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
                    _swalMessage    =   'Berhasil menyimpan data sub standart!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan data sub standart! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Sub Standart',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/SubStandart'))?>`;
                    }
                });
            }
        });
    });
</script>