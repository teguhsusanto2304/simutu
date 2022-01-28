<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Administrator',
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
                    $contentHeaderOptions   =   ['pageName' => 'Administrator'];
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
                                                <h5>Administrator</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('admin/add'))?>">
                                                    <button class="btn btn-link btn-sm">Administrator Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelAdministrator'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Administrator</th>
                                                <th class='border-top-0 text-left text-bold'>Kontak</th>
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
    let _uploadGambarAdmin          =   '<?=$path->uploadGambarAdmin?>';

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('admin/listAdmin'))?>${location.search}`,
            dataSrc     :   'listAdmin'
        },
        
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _isActive   =   data.isActive;
                _isActive       =   (_isActive == 1);

                let _isActiveHTML   =   `<span class='ml-1 badge badge-danger'>Akun di Nonaktifkan!</span>`;
                if(_isActive){
                    _isActiveHTML   =   `<span class='ml-1 badge badge-success'>Akun Aktif!</span>`;
                }

                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${data.foto}' alt='${data.firstName}'
                                class='img-circle w-50-50' />
                            <div class='col'>
                                <h6 class='text-primary text-bold mb-0'>
                                    ${data.firstName} ${data.lastName}
                                </h6>
                                <span class='text-muted' style='font-size:.80rem;'>NIP <b>${data.nip}</b></span>
                                ${_isActiveHTML}
                                <p class='text-sm text-muted mb-0 mt-1'>${data.alamat}</span>
                            </div>
                        </div>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _email      =   data.email;
                let _telepon    =   data.telepon;

                let _kontakHTML     =   `<div class='text-left'>
                                            <p class='text-sm mb-1'>
                                                <span class='fa fa-phone mr-2'></span>${_telepon}
                                            </p>
                                            <p class='text-sm mb-1'>
                                                <span class='far fa-envelope mr-2'></span>${_email}
                                            </p>
                                        </div>`;

                return _kontakHTML;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _creatorHTML = `<i class="text-sm text-muted">Tanpa Creator</i>`;

                if(data.detailCreator !== undefined){
                    let _detailCreator  =   data.detailCreator;

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
                let _idAdministrator        =   data.userid;
                let _namaAdministratorUC    =   data.nama;

                let _isActive   =   data.isActive;
                _isActive       =   (_isActive == 1);

                let _toggleAktifNonAktifkan     =   `<span class='fa fa-power-off text-success cp' data-toggle='tooltip' data-placement='top'
                                                        title='Aktifkan ${_namaAdministratorUC}' 
                                                        onClick='toggleAktifNonAktifkan(this, "${_idAdministrator}", "${_namaAdministratorUC}", ${_isActive})'></span>`;
                if(_isActive){
                    _toggleAktifNonAktifkan     =   `<span class='fa fa-power-off text-danger cp' data-toggle='tooltip' data-placement='top'
                                                        title='Non Aktifkan ${_namaAdministratorUC}' 
                                                        onClick='toggleAktifNonAktifkan(this, "${_idAdministrator}", "${_namaAdministratorUC}", ${_isActive})'></span>`;
                }

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/admin/add/${_idAdministrator}'>
                                <span class='fa fa-edit text-warning cp mr-2' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Administrator ${_namaAdministratorUC}'></span>
                            </a>
                            ${_toggleAktifNonAktifkan}
                        </div>`;
            }}
        ]
    };

    let _adminDataTable   =   $('#tabelAdministrator').DataTable(_dataTableOptions);

    async function toggleAktifNonAktifkan(thisContext, idAdministrator, namaAdministrator, isActive) {
        let _el                 =   $(thisContext);

        let _action         =   (isActive)? 'penonaktifan' : 'pengaktifan';

        let _title          =    `Konfirmasi ${(isActive)? 'Penonaktifan' : 'Pengaktifan'}`;
        let _htmlMessage    =   `Apakah anda yakin akan <b class='text-${(isActive)? 'danger' : 'success'}'>${_action}</b> administrator <b class='text-primary'>${namaAdministrator}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('admin/process_toggleAktifNonAktif'))?>',
                data    :   `idAdministrator=${idAdministrator}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _status    =   decodedRFS.status;
                    
                    let _title  =   'Penonaktifan Administrator';
                    let _icon, _message, _onClick;
                    if(_status){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil ${_action} Administrator!</span>`;   
                        _onClick    =   function(){
                            _adminDataTable.draw();
                        };
                    }else{
                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>${decodedRFS.message}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>
