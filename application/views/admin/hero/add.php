<?php 
    $cF =   $this->cF;

    $judulParams                =   ['placeholder' => 'Judul Hero Slider', 'name' => 'judul', 'id' => 'judul'];
    $urutanParams               =   ['placeholder' => 'Urutan Hero', 'name' => 'urutan', 'id' => 'urutan', 'type' => 'number'];

    if($detailHero !== false){
        $judulParams['value']    =   $detailHero['judul'];
        $urutanParams['value']   =   $detailHero['urutan'];
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
                        'pageName'  =>  ($detailHero !== false)? 'Edit Data Hero' : 'Add New Hero'
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
                                                <h5><?=($detailHero !== false)? 'Edit Data Hero' : 'Hero Baru'?></h5>
                                                <?php if($detailHero !== false){ ?>
                                                    <p class='mb-0 text-muted text-sm'><?=strtoupper($detailHero['judul'])?></p>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('hero'))?>" class='btn btn-link'>
                                                    Back to List Hero
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formHero">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='heroImg'>
                                                        <img src="<?=base_url(($detailHero !== false)? $this->path->uploadGambarHero.'/'.$detailHero['foto'] : 'assets/img/upload-icon.png')?>" 
                                                            alt="Foto Hero" id='heroImgPreview'
                                                            class='w-100 cp <?=($detailHero !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' />
                                                        <input type="file" id='heroImg' onChange='heroImgChanged(this, event)'
                                                            style='display:none;' name='heroImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 1920px x 1080px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="row">
                                                        <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($judulParams, 'Judul Hero')?>
                                                        </div>
                                                        <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                                            <?=$cF->textField($urutanParams, 'Urutan')?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi" class='label-title'>Deskripsi</label>
                                                        <textarea class="form-control input" name='deskripsi' id='deskripsi' required
                                                            placeholder='Deskripsi'><?=($detailHero !== false)? $detailHero['deskripsi'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit' id='btnSubmit'>
                                                            Simpan <?=($detailHero !== false)? 'Perubahan' : ''?> Data Hero
                                                    </button>
                                                    <a href="<?=site_url(adminControllers('hero'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Hero</button>
                                                    </a>
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
    let baseURL             =   '<?=base_url()?>';
    let adminControllers    =   '<?=adminControllers()?>';
    let _isUpdateHero       =   '<?=($detailHero !== false)? 'true' : 'false'?>';
    _isUpdateHero           =   (_isUpdateHero === 'true');

    let _idHero             =   '<?=($detailHero !== false)? '/'.$detailHero['id'] : '' ?>';

    let heroImgPreview     =   false;
    let heroImgData        =   false;

    $('#formHero').on('submit', function(e){
        e.preventDefault();
        
        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();

        _btnSubmit.prop('disabled', true).text('Processing ..');

        let dataHero   =   new FormData();

        dataHero.append('foto', heroImgData);
        dataHero.append('judul', $('#judul').val());
        dataHero.append('urutan', $('#urutan').val());
        dataHero.append('deskripsi', $('#deskripsi').val());

        $.ajax({
            url     :   `${baseURL}/${adminControllers}/hero/process_save${_idHero}`,
            data    :   dataHero,
            type    :   'POST',
            processData     :   false,
            contentType     :   false,
            cache   :   false,
            success     :   function(_decodedRFS){
                let _statusSave     =   _decodedRFS.statusSave;

                let _title      =   'Hero';
                let _action     =   (_isUpdateHero)? 'Mengedit' : 'Menambah';
                   
                let _message, _type, _onClick;
                if(_statusSave){
                    _onClick    =   () => location.href = '<?=base_url(adminControllers('hero'))?>';
                    _type       =   'success';
                    _message    =   `<span class='text-success'>Berhasil ${_action} data Hero!</span>`;
                }else{
                    _onClick    =   null;
                    _type       =   'error';
                    _message    =   `<span class='text-danger'>Gagal ${_action} data Hero! <br /> ${_decodedRFS.message}`;
                }

                _btnSubmit.prop('disabled', false).text(_btnSubmitText);
                notificationSwal(_title, _message, _type, _onClick);
            }
        });
    });

    function heroImgChanged(thisContext){
        let el          =   $(thisContext);
        let imgData     =   el.prop('files')[0];

        let fileReader  =   new FileReader();
        fileReader.readAsDataURL(imgData);
        fileReader.onload   =   (e) =>  {
            let imgResult   =   e.target.result;
            heroImgPreview    =   imgResult;
            heroImgData       =   imgData;

            $('#heroImgPreview').attr('src', heroImgPreview).addClass('img-thumbnail');
        }
    }
</script>