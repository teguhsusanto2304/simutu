<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Hero Slider',
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
                    $contentHeaderOptions   =   ['pageName' => 'Hero'];
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class='card-header'>
                                        <div class="row">
                                            <div class='col'>
                                                <h5 class='mb-0'>Daftar Hero</h5>
                                            </div>
                                            <div class='col text-right'>
                                                <a href="<?=site_url(adminControllers('hero/add'))?>">
                                                    <button class="btn btn-link">Add New Hero</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped" id='tabelHero'>
                                                <thead>
                                                    <tr>
                                                        <td class='text-center'>No.</td>
                                                        <td class='text-left'>Hero</td>
                                                        <td class='text-left'>Deskripsi</td>
                                                        <td class='text-center'>Opsi</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
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
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js')
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
    let _uploadGambarHero           =   '<?=$this->path->uploadGambarHero?>';
    let _uploadGambarAdmin          =   '<?=$this->path->uploadGambarAdmin?>';

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('hero/listHero'))?>${location.search}`,
            dataSrc     :   'dataHero'
        },
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailAdmin    =   data.detailAdmin;
                let _adminHTML;

                if(_detailAdmin !== false){
                    _adminHTML  =   `<div class='row'>
                                        <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailAdmin.foto}' alt='Foto ${_detailAdmin.nama}' 
                                            class='img-circle w-25-25' />
                                        <span class='text-sm text-muted ml-2'>Didaftarkan oleh ${_detailAdmin.nama}</span>
                                    </div>`;
                }else{
                    _adminHTML  =   `<i class='text-sm text-muted'>Didaftarkan oleh Admin tidak dikenal!</i>`;
                }

                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarHero}/compress/${data.foto}' alt='Foto ${data.judul}' class='img-circle w-50-50' />
                            <div class='col pl-3'>
                                <h6 class='text-primary text-bold mb-1'>
                                    ${data.judul}
                                </h6>
                                ${_adminHTML}
                            </div>
                        </div>
                        `;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _deskripsi  =   data.deskripsi;
                if(_deskripsi.length >= 100){
                    _deskripsi  =   _deskripsi.substring(0, 100);
                    _deskripsi  =   `${_deskripsi} ...`;
                }
                return  `${_deskripsi}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idHero         =   data.id;
                let _judulHeroUC    =   data.judul.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/hero/edit/${_idHero}'>
                                <span class='fa fa-edit text-warning cp mr-1' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Hero ${_judulHeroUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp ml-2 ml-1' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Hero ${_judulHeroUC}' onClick='hapusHero(this, "${_idHero}", "${_judulHeroUC}")'></span>
                        </div>
                        `;
            }}
        ]
    };

    let _heroDataTable   =   $('#tabelHero').DataTable(_dataTableOptions);

    async function hapusHero(thisContext, idHero, judulHero) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus hero <b class='text-primary'>${judulHero}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('hero/process_delete'))?>',
                data    :   `idHero=${idHero}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapusHero    =   decodedRFS.statusHapusHero;
                    
                    let _title  =   'Hapus Hero';
                    let _icon, _message, _onClick;
                    if(_statusHapusHero){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus hero!</span>`;   
                        _onClick    =   function(){
                            _heroDataTable.draw();
                        };
                    }else{
                        let _messageHapusHero   =   decodedRFS.messageHapusHero;

                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>${_messageHapusHero}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>
