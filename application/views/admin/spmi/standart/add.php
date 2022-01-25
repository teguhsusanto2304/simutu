<?php
    $cF     =   $this->cF;

    $kodeParams    =   [
        'id'    =>  'kodeStandar',
        'name'  =>  'kodeStandar',
        'placeholder'   =>  'Kode Standart'
    ];
     $namaParams    =   [
        'id'    =>  'namaStandar',
        'name'  =>  'namaStandar',
        'placeholder'   =>  'Nama Standart'
    ];

    if($detailStandart !== false){
        $kodeParams['value']   =   $detailStandart['kodeStandar'];
        $namaParams['value']   =   $detailStandart['namaStandar'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Standart'];
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
                                                <h5><?=($detailStandart !== false)? 'Edit Standart' : 'Standart Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/Standart'))?>">
                                                    <button class="btn btn-link btn-sm">List Standart</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formStandart">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <?=$cF->textField($kodeParams, 'Kode Standart')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?=$cF->textField($namaParams, 'Nama Standart')?>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailStandart !== false)? 'Perubahan' : ''?> Data Standart</button>
                                                    <a href="<?=site_url(adminControllers('spmi/Standart'))?>">
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

    let idStandart      =   '<?=($detailStandart !== false)? '/'.$detailStandart['standarId'] : ''?>';

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
        _formData.append('kodeStandar', $('#kodeStandar').val());
        _formData.append('namaStandar', $('#namaStandar').val());

        $.ajax({
            url     :   `<?=site_url(adminControllers('spmi/Standart/process_save'))?>${idStandart}`,
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
                    _swalMessage    =   'Berhasil menyimpan data standart!';
                    _swalType       =   'success';
                }else{
                    _swalMessage    =   'Gagal menyimpan data standart!';
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Standart',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('spmi/Standart'))?>`;
                    }
                });
            }
        });
    });
</script>