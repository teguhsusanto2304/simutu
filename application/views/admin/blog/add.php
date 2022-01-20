<?php
    $cF     =   $this->cF;

    $titleParams    =   [
        'id'    =>  'title',
        'name'  =>  'title',
        'placeholder'   =>  'Tempe Harga Rakyat Rasa Bintang 5'
    ];

    if($detailBlog !== false){
        $titleParams['value']   =   $detailBlog['title'];
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
                    $contentHeaderOptions   =   ['pageName' => 'Blog'];
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
                                                <h5><?=($detailBlog !== false)? 'Edit Blog' : 'Blog Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url('blog')?>">
                                                    <button class="btn btn-link btn-sm">List Blog</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formBlog">
                                            <div class="row">
                                                <div class="col-lg-4 text-center">
                                                    <label for='blogImage'>
                                                        <img src="<?=base_url(($detailBlog !== false)? $path->uploadGambarBlog.'/'.$detailBlog['foto'] : 'assets/img/upload-icon.png')?>" alt="Gambar Blog" 
                                                            class='w-100 cp <?=($detailBlog !== false)? 'img-thumbnail' : ''?> ' data-toggle='tooltip'
                                                            data-placement='left' title='Klik Gambar untuk Memilih Gambar' id='imgPreview' />
                                                        <input type="file" id='blogImage' onChange='imgChanged(this)'
                                                            style='display:none;' name='blogImg' />
                                                    </label>
                                                    <span class="badge badge-warning">Ukuran yang disarankan 1920px x 1080px</span>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <?=$cF->textField($titleParams, 'Judul Blog')?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="content" class='label-title'>Content</label>
                                                        <textarea class="form-control input" name='content'
                                                            placeholder='Content Blog'
                                                            id='content'><?=($detailBlog !== false)? $detailBlog['content'] : ''?></textarea>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailBlog !== false)? 'Perubahan' : ''?> Data Blog</button>
                                                    <a href="<?=site_url('blog')?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Blog</button>
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
<script src="<?=base_url('assets/plugins/ckfinder_php_3.5.2/ckfinder/ckfinder.js')?>"></script>
<script language='Javascript'>
    let baseURL             =   '<?=base_url()?>';

    let imgPreview  =   false;
    let imgData     =   false;

    let idBlog      =   '<?=($detailBlog !== false)? '/'.$detailBlog['id'] : ''?>';

    ClassicEditor
        .create(document.getElementById('content'), {
            toolbar     :   {
                items   :   ckEditorToolbarsCustomBuild
            },
            removePlugins   :   ['Markdown'],
            ckfinder    :   {
                uploadUrl   :   `<?=site_url('assets/plugins/ckfinder_php_3.5.2/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json')?>`
            }
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

    $('#formBlog').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _editorData     =   window.editor.getData();

        let _formData   =   new FormData();
        if(imgData !== false){
            _formData.append('img', imgData);
        }
        _formData.append('title', $('#title').val());
        _formData.append('content', _editorData);

        let _fragment   =   document.createRange().createContextualFragment(_editorData);
        let _imgs       =   _fragment.querySelectorAll('img');

        let _listStringImg  =   '';
        if(_imgs.length >= 1){
            _imgs.forEach((item, index) => {
                let _imgJQuery      =   $(item);
                let _commaSeparator =   (index == (_imgs.length - 1))? '' : ',';
                _listStringImg  +=  `${_imgJQuery.attr('src')}${_commaSeparator}`;
            });
        }

        _formData.append('contentImgs', _listStringImg);

        $.ajax({
            url     :   `<?=site_url(adminControllers('blog/process_save'))?>${idBlog}`,
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
                    _swalMessage    =   'Berhasil menyimpan data blog!';
                    _swalType       =   'success';
                }else{
                    _swalMessage    =   'Gagal menyimpan data blog!';
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Blog',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('blog'))?>`;
                    }
                });
            }
        });
    });
</script>