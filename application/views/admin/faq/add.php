<?php
    $cF     =   $this->cF;

    $titleParams    =   [
        'id'    =>  'title',
        'name'  =>  'title',
        'placeholder'   =>  'Apa manfaat makan tempe?'
    ];

    if($detailFAQ !== false){
        $titleParams['value']   =   $detailFAQ['title'];
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
                    $contentHeaderOptions   =   ['pageName' => $pageTitle];
                    if($detailFAQ !== false){
                        $contentHeaderOptions['pageNameSubTitle']   =   $detailFAQ['title'];
                    }
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
                                                <h5><?=($detailFAQ !== false)? 'Edit FAQ' : 'FAQ Baru'?></h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('faq'))?>">
                                                    <button class="btn btn-link btn-sm">List FAQ</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formFAQ">
                                            <div class="form-group">
                                                <?=$cF->textField($titleParams, 'Judul FAQ')?>
                                            </div>
                                            <div class="form-group">
                                                <label for="content" class='label-title'>Content</label>
                                                <textarea class="form-control input" name='content'
                                                    placeholder='Content FAQ'
                                                    id='content'><?=($detailFAQ !== false)? $detailFAQ['content'] : ''?></textarea>
                                            </div>
                                            <hr class='mb-4' />
                                            <button class="btn btn-success mr-1" type='submit'
                                                id='btnSubmit'>Simpan <?=($detailFAQ !== false)? 'Perubahan' : ''?> Data FAQ</button>
                                            <a href="<?=site_url(adminControllers('faq'))?>">
                                                <button class="btn btn-default ml-1" type='button'>Back to List FAQ</button>
                                            </a>
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

    let idFAQ      =   '<?=($detailFAQ !== false)? '/'.$detailFAQ['id'] : ''?>';

    let _excludeToolbar         =   [
        'imageInsert', 'imageTextAlternative', 'toggleImageCaption', 'resizeImage', 'imageStyle:inline', 'imageStyle:alignLeft', 
        'imageStyle:alignRight', 'imageStyle:alignCenter', 'imageStyle:alignBlockLeft', 'imageStyle:alignBlockRight', 'imageStyle:block', 
        'imageStyle:side', 'imageStyle:wrapText', 'imageStyle:breakText', 'pageBreak', 'textPartLanguage'
    ];
    ckEditorToolbarsCustomBuild =   ckEditorToolbarsCustomBuild.filter((item) => !_excludeToolbar.includes(item));

    ClassicEditor
        .create(document.getElementById('content'), {
            toolbar     :   {
                items   :   ckEditorToolbarsCustomBuild
            },
            removePlugins   :   ['Markdown']
        })
        .then((editor) => window.editor = editor);

    $('#formFAQ').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _editorData     =   window.editor.getData();

        let _formData   =   new FormData();
        _formData.append('title', $('#title').val());
        _formData.append('content', _editorData);

        $.ajax({
            url     :   `<?=site_url(adminControllers('faq/process_save'))?>${idFAQ}`,
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
                    _swalMessage    =   'Berhasil menyimpan data FAQ!';
                    _swalType       =   'success';
                }else{
                    _swalMessage    =   'Gagal menyimpan data FAQ!';
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'FAQ',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('faq'))?>`;
                    }
                });
            }
        });
    });
</script>