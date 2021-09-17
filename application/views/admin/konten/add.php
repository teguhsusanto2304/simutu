<?php 
    $cF =   $this->cF;

    $pageParams         =   ['placeholder' => 'Halaman', 'name' => 'page', 'id' => 'page'];
    $namaDivisiParams   =   ['placeholder' => 'Nama Divisi', 'name' => 'namaDivisi', 'id' => 'namaDivisi'];
    $urutanParams       =   ['placeholder' => 'Urutan Konten', 'name' => 'urutan', 'id' => 'urutan', 'type' => 'number'];

    if($detailKonten !== false){
        $pageParams['value']        =   $detailKonten['page'];
        $namaDivisiParams['value']  =   $detailKonten['namaDivisi'];
        $urutanParams['value']      =   $detailKonten['urutan'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
    <?php 
        $contentHeaderData  =   [
            'pageTitle'     =>  $pageName,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css')
                ]
            ]  
        ];
        $this->load->view(adminComponents('head'), $contentHeaderData); 
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
                        'pageName'  =>  ($detailKonten !== false)? 'Edit Data Konten' : 'Add New Konten'
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
                                                <h5><?=($detailKonten !== false)? 'Edit Data Konten' : 'Konten Baru'?></h5>
                                                <?php if($detailKonten !== false){ ?>
                                                    <p class='mb-0 text-muted text-sm'><?=strtoupper($detailKonten['namaDivisi'])?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('konten'))?>" class='btn btn-link'>
                                                    Back to List Konten
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formKonten">
                                            <div class="row">
                                                <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                                    <?=$cF->textField($pageParams, 'Halaman Divisi')?>
                                                </div>
                                                <div class="form-group col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                                    <?=$cF->textField($namaDivisiParams, 'Nama Divisi')?>
                                                </div>
                                                <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                    <?=$cF->textField($urutanParams, 'Urutan')?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsiDivisi" class='label-title'>Deskripsi</label>
                                                <textarea class="form-control input" name='deskripsiDivisi' id='deskripsiDivisi' required
                                                    placeholder='Deskripsi'><?=($detailKonten !== false)? $detailKonten['deskripsiDivisi'] : ''?></textarea>
                                            </div>
                                            <hr class='mb-4' />
                                            <button class="btn btn-success mr-1" type='submit' id='btnSubmit'>
                                                    Simpan <?=($detailKonten !== false)? 'Perubahan' : ''?> Data Konten
                                            </button>
                                            <a href="<?=site_url(adminControllers('konten'))?>">
                                                <button class="btn btn-default ml-1" type='button'>Back to List Konten</button>
                                            </a>
                                                
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
    let baseURL             =   '<?=base_url()?>';
    let adminControllers    =   '<?=adminControllers()?>';
    let _isUpdateKonten     =   '<?=($detailKonten !== false)? 'true' : 'false'?>';
    _isUpdateKonten         =   (_isUpdateKonten === 'true');

    let _idKonten           =   '<?=($detailKonten !== false)? '/'.$detailKonten['id'] : '' ?>';

    $('#formKonten').on('submit', function(e){
        e.preventDefault();
        
        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();

        _btnSubmit.prop('disabled', true).text('Processing ..');

        let dataKonten   =   new FormData();

        dataKonten.append('page', $('#page').val());
        dataKonten.append('namaDivisi', $('#namaDivisi').val());
        dataKonten.append('deskripsiDivisi', $('#deskripsiDivisi').val());
        dataKonten.append('urutan', $('#urutan').val());

        $.ajax({
            url     :   `${baseURL}/${adminControllers}/konten/process_save${_idKonten}`,
            data    :   dataKonten,
            type    :   'POST',
            processData     :   false,
            contentType     :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                let _statusSave     =   _decodedRFS.statusSave;

                let _title      =   'Konten';
                let _action     =   (_isUpdateKonten)? 'Mengedit' : 'Menambah';
                   
                let _message, _type, _onClick;
                if(_statusSave){
                    _onClick    =   () => location.href = '<?=base_url(adminControllers('konten'))?>';
                    _type       =   'success';
                    _message    =   `<span class='text-success'>Berhasil ${_action} data Konten!</span>`;
                }else{
                    _onClick    =   null;
                    _type       =   'error';
                    _message    =   `<span class='text-danger'>Gagal ${_action} data Konten! <br /> ${_decodedRFS.message}`;
                }

                _btnSubmit.prop('disabled', false).text(_btnSubmitText);
                notificationSwal(_title, _message, _type, _onClick);
            }
        });
    });
</script>