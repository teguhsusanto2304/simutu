<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Galeri',
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
                    $contentHeaderOptions   =   ['pageName' => 'Galeri'];
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
                                                <h5 class='mb-0'>Galeri</h5>
                                            </div>
                                            <div class='col text-right'>
                                                <a href="<?=site_url(adminControllers('galeri/add'))?>">
                                                    <button class="btn btn-link">Add New Galeri</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped" id='tabelGaleri'>
                                                <thead>
                                                    <tr>
                                                        <td class='text-center'>No.</td>
                                                        <td class='text-left'>Galeri</td>
                                                        <td class='text-left'>Update</td>
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
    let _uploadGambarGaleri         =   '<?=$path->uploadGambarGaleri?>';
    let _uploadGambarAdmin          =   '<?=$path->uploadGambarAdmin?>';

    let _select     =   `select=id, judul, foto, createdBy, createdAt, updatedBy, updatedAt`;

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('galeri/listGaleri?'))?>${_select}${location.search}`,
            dataSrc     :   'listGaleri'
        },
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailCreator    =   data.detailCreator;
                let _adminHTML;

                if(_detailCreator !== false){
                    _adminHTML  =   `<div class='row'>
                                        <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailCreator.foto}' alt='Foto ${_detailCreator.nama}' 
                                            class='img-circle w-25-25' />
                                        <span class='text-sm text-muted ml-2'>Didaftarkan oleh <b>${_detailCreator.nama}</b></span>
                                    </div>`;
                }else{
                    _adminHTML  =   `<i class='text-sm text-muted'>Creator tidak dikenal!</i>`;
                }

                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarGaleri}/compress/${data.foto}' alt='Foto ${data.judul}' 
                                class='img-circle w-50-50' />
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
                let _detailUpdater  =   data.detailUpdater;
                let _updaterHTML;

                if(_detailUpdater === null){
                    _updaterHTML    =   `<i class='text-sm text-muted'>Belum pernah diupdate !</i>`;
                }else{
                    if(_updaterHTML !== false){
                        let _updateTime =   convertDateTime(data.updatedAt);
                        _updaterHTML    =   `<div class='row'>
                                                <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailUpdater.foto}' alt='Foto ${_detailUpdater.nama}' 
                                                    class='img-circle w-50-50' />
                                                <div class='col pl-3'>
                                                    <h6 class='text-primary text-bold mb-0'>
                                                        ${_detailUpdater.nama}
                                                    </h6>
                                                    <span class='text-sm text-muted'>Pada <b>${_updateTime}</b></span>
                                                </div>
                                            </div>`;
                    }else{
                        _updaterHTML    =   `<i class='text-sm text-muted'>Updater tidak terdaftar !</i>`;
                    }
                }
                return  _updaterHTML;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idGaleri         =   data.id;
                let _judulGaleriUC    =   data.judul.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/galeri/edit/${_idGaleri}'>
                                <span class='fa fa-edit text-warning cp' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Galeri ${_judulGaleriUC}'></span>
                            </a>
                            <a href='${_siteURL}${_adminControllers}/galeri/foto/${_idGaleri}'>
                                <span class='fa fa-image text-success cp mx-2' data-toggle='tooltip' data-placement='top'
                                    title='Atur Foto Galeri ${_judulGaleriUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Galeri ${_judulGaleriUC}' onClick='hapusGaleri(this, "${_idGaleri}", "${_judulGaleriUC}")'></span>
                        </div>
                        `;
            }}
        ]
    };

    let _galeriDataTable   =   $('#tabelGaleri').DataTable(_dataTableOptions);

    async function hapusGaleri(thisContext, idGaleri, judulGaleri) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus galeri <b class='text-primary'>${judulGaleri}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('galeri/process_delete'))?>',
                data    :   `idGaleri=${idGaleri}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Hapus Galeri';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus galeri!</span>`;   
                        _onClick    =   function(){
                            _galeriDataTable.draw();
                        };
                    }else{
                        let _messageHapus   =   decodedRFS.messageHapus;

                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>Gagal menghapus galeri! ${_messageHapus}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>
