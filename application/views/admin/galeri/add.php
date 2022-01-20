<?php
    $cF     =   $this->cF;

    $judulParams    =   [
        'id'            =>  'judul',
        'name'          =>  'judul',
        'placeholder'   =>  'Nama Album (Galeri)'
    ];

    if($detailGaleri !== false){
        $judulParams['value']   =   $detailGaleri['judul'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Galeri'];
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
                                                <h5><?=($detailGaleri !== false)? 'Edit Galeri' : 'Galeri Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('galeri'))?>">
                                                    <button class="btn btn-link btn-sm">List Galeri</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formGaleri">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='galeriImage'>
                                                        <img src="<?=base_url(($detailGaleri !== false)? $path->uploadGambarGaleri.'/'.$detailGaleri['foto'] : 'assets/img/upload-icon.png')?>" 
                                                            alt="Gambar Galeri" 
                                                            class='w-100 cp <?=($detailGaleri !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' id='imgPreview' />
                                                        <input type="file" id='galeriImage' onChange='imgChanged(this)'
                                                            style='display:none;' name='galeriImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 1920px x 1080px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <?=$cF->textField($judulParams, 'Judul Galeri')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="deskripsi" class='label-title'>Deskripsi</label>
                                                        <textarea class="form-control input" name='deskripsi'
                                                            placeholder='Deskripsi Galeri/Album'
                                                            id='deskripsi'><?=($detailGaleri !== false)? $detailGaleri['deskripsi'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailGaleri !== false)? 'Perubahan' : ''?> Data Galeri</button>
                                                    <a href="<?=site_url(adminControllers('galeri'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Galeri</button>
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
                        base_url('assets/plugins/ckeditor5/build/ckeditor.js')
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

    let idGaleri    =   '<?=($detailGaleri !== false)? '/'.$detailGaleri['id'] : ''?>';
    
    let _excludeToolbar         =   [
        'imageInsert', 'imageTextAlternative', 'toggleImageCaption', 'resizeImage', 'imageStyle:inline', 'imageStyle:alignLeft', 
        'imageStyle:alignRight', 'imageStyle:alignCenter', 'imageStyle:alignBlockLeft', 'imageStyle:alignBlockRight', 'imageStyle:block', 
        'imageStyle:side', 'imageStyle:wrapText', 'imageStyle:breakText', 'pageBreak', 'textPartLanguage'
    ];
    ckEditorToolbarsCustomBuild =   ckEditorToolbarsCustomBuild.filter((item) => !_excludeToolbar.includes(item));

    ClassicEditor
        .create(document.getElementById('deskripsi'), {
            toolbar     :   {
                items   :   ckEditorToolbarsCustomBuild
            },
            removePlugins   :   ['Markdown']
        })
        .then((editor) => window.editor = editor);

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

    $('#formGaleri').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _deskripsi  =   editor.getData();

        let _formData   =   new FormData();
        if(imgData !== false){
            _formData.append('foto', imgData);
        }
        _formData.append('judul', $('#judul').val());
        _formData.append('deskripsi', _deskripsi);
 
        $.ajax({
            url     :   `<?=site_url(adminControllers('galeri/process_save'))?>${idGaleri}`,
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
                    _swalMessage    =   'Berhasil menyimpan data galeri!';
                    _swalType       =   'success';
                    _onClick        =   () => {location.href   =   `<?=site_url(adminControllers('galeri'))?>`;};
                }else{
                    _swalMessage    =   'Gagal menyimpan data galeri!';
                    _swalType       =   'error';
                    _onClick        =   null;
                }

                notificationSwal('Galeri', _swalMessage, _swalType, _onClick);
            }
        });
    });
</script>