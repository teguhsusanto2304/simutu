<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Blog',
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css'),
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
                                                <h5>Blog</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('blog/add'))?>">
                                                    <button class="btn btn-link btn-sm">Blog Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelBlog'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Blog</th>
                                                <th class='border-top-0 text-left text-bold'>Creator</th>
                                                <th class="border-top-0 text-left text-bold">Update</th>
                                                <th class='border-top-0 text-center text-bold'>Action</th>
                                            </thead>
                                        </table>
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
                        base_url('assets/plugins/datatables/jquery.dataTables.min.js'),
                        base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'),
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/myJS/dateConverter.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<script language='Javascript'>
    let _baseURL                    =   `<?=base_url()?>`;
    let _siteURL                    =   `<?=site_url()?>`;
    let _adminControllers           =   `<?=adminControllers()?>`;
    let _uploadGambarBlog           =   '<?=$path->uploadGambarBlog?>';
    let _uploadGambarAdmin          =   '<?=$path->uploadGambarAdmin?>';

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('blog/listBlog'))?>${location.search}`,
            dataSrc     :   'listBlog'
        },
        
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarBlog}/compress/${data.foto}' alt='${data.title}'
                                class='img-circle w-50-50' />
                            <div class='col'>
                                <h6 class='text-primary text-bold mb-0'>
                                    ${data.title}
                                </h6>
                                <span class='text-muted' style='font-size:.80rem;'>Link <b>${data.permalink}</b></span>
                            </div>
                        </div>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailCreator  =   data.detailCreator;

                let _creatorHTML;
                if(_detailCreator !== false){
                    _creatorHTML    =   `<div class='row'>
                                            <a href='${_baseURL}/${_uploadGambarAdmin}/${_detailCreator.foto}' target='_blank'>
                                                <img src='${_baseURL}/${_uploadGambarAdmin}/${_detailCreator.foto}' alt='${_detailCreator.nama}' 
                                                    class='img-circle w-50-50' />
                                            </a>
                                            <div class='col pl-3'>
                                                Dibuat oleh <b class='mb-1 text-bold text-secondary'>${_detailCreator.nama}</b>
                                                <p class='mb-0 text-sm text-muted'>pada <b>${convertDateTime(data.createdAt, ' ', true)}</b></p>
                                            </div>
                                        </div>`;
                }else{
                    _creatorHTML    =   `<i class='text-sm text-muted'>Creator tidak dikenal</i>`;
                }

                return  `${_creatorHTML}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _updaterHTML;
                if(data.updatedBy != null){
                    let _detailUpdater  =   data.detailUpdater;
                   if(_detailUpdater !== false){
                        _updaterHTML    =   `<div class='mb-0 text-sm row'>
                                            <a href='${_baseURL}/${_uploadGambarAdmin}/${_detailUpdater.foto}' target='_blank'>
                                                <img src='${_baseURL}${_uploadGambarAdmin}/${_detailUpdater.foto}' class='img-circle w-50-50' 
                                                alt='${_detailUpdater.nama}' />
                                            </a>
                                            <div class='col pl-3'>
                                                Diupdate <b class='text-muted'>oleh ${_detailUpdater.nama}</b>
                                                <p class='text-sm mb-0 text-muted'>Pada <b>${convertDateTime(data.updatedAt, ' ', true)}</b></p>
                                            </div>
                                        </div>`;
                   }else{
                       _updaterHTML     =   `<i class='text-sm text-muted'>Updater tidak dikenal!</i>`;
                   }
                }else{
                    _updaterHTML    =   `<i class='text-sm text-muted'>Belum pernah diupdate</i>`;
                }

                return _updaterHTML;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idBlog         =   data.id;
                let _titleBlogUC    =   data.title.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/blog/edit/${_idBlog}'>
                                <span class='fa fa-edit text-warning cp mr-2' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Blog ${_titleBlogUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Blog ${_titleBlogUC}' onClick='hapusBlog(this, "${_idBlog}", "${_titleBlogUC}")'></span>
                        </div>`;
            }}
        ]
    };

    let _blogDataTable   =   $('#tabelBlog').DataTable(_dataTableOptions);

    async function hapusBlog(thisContext, idBlog, judulBlog) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus blog <b class='text-primary'>${judulBlog}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('blog/process_delete'))?>',
                data    :   `idBlog=${idBlog}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Hapus Blog';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus blog!</span>`;   
                        _onClick    =   function(){
                            _blogDataTable.draw();
                        };
                    }else{
                        let _messageHapus   =   decodedRFS.messageHapus;

                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>${_messageHapus}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>
