<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
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
                    $contentHeaderOptions   =   ['pageName' => $pageTitle];
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
                                                <h5><?=$pageTitle?></h5>
                                            </div>
                                            <?php if($loadedFrom == $loadedFrom_programStudi){ ?>
                                                <div class="col-lg-8 text-right">
                                                    <a href="<?=site_url(adminControllers('ProgramStudi/add'))?>">
                                                        <button class="btn btn-link btn-sm">Prodi Baru</button>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelProdi'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Kode Prodi</th>
                                                <th class='border-top-0 text-left text-bold'>Prodi</th>
                                                <th class='border-top-0 text-left text-bold'>SK</th>
                                                <th class='border-top-0 text-left text-bold'>Peringkat Akreditasi</th>
                                                <th class='border-top-0 text-left text-bold'>No SK BAN PT</th>
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

    let _loadedFrom                 =   `<?=$loadedFrom?>`;
    let _loadedFrom_programStudi    =   `<?=$loadedFrom_programStudi?>`;
    let _loadedFrom_penetapan       =   `<?=$loadedFrom_penetapan  ?>`;

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('ProgramStudi/listProgramStudi'))?>${location.search}`,
            dataSrc     :   'listProgramStudi'
        },
        
        columns     :   [          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `${data.programStudiCode}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `${data.namaProgramStudi}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `${data.numberSK}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `${data.peringkatAkreditasi}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `${data.noSKBANPT}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idProdi          =   data.idprogramstudi;
                let _namaProdiUC      =   data.namaProgramStudi.toUpperCase();

                let _actionHTML;
                if(_loadedFrom === _loadedFrom_programStudi){
                    _actionHTML     =   `<a href='${_siteURL}${_adminControllers}/ProgramStudi/edit/${_idProdi}'>
                                                <span class='fa fa-edit text-warning cp' data-toggle='tooltip' data-placement='top'
                                                    title='Edit Data Program Studi ${_namaProdiUC}'></span>
                                            </a>
                                            <span class='fa fa-trash text-danger cp mx-3' data-toggle='tooltip' data-placement='top'
                                                title='Hapus Data Program Studi ${_namaProdiUC}' onClick='hapusProdi(this, "${_idProdi}", "${_namaProdiUC}")'></span>`;
                }
                if(_loadedFrom === _loadedFrom_penetapan){
                    _actionHTML     =   `<a href='${_siteURL}${_adminControllers}/ProgramStudi/penetapan/${_idProdi}'>
                                            <span class='fa fa-arrow-right text-success cp' data-toggle='tooltip' data-placement='top'
                                                title='Penetapan Program Studi ${_namaProdiUC}' onClick='penetapanProdi(this, "${_idProdi}", "${_namaProdiUC}")'></span>
                                        </a>`;
                }

                return `<div class='text-center'>
                            ${_actionHTML}
                        </div>`;
            }}
        ]
    };

    let _prodiDataTable   =   $('#tabelProdi').DataTable(_dataTableOptions);

    async function hapusProdi(thisContext, idProgramStudi, judulProdi) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus program studi <b class='text-primary'>${judulProdi}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('ProgramStudi/process_delete'))?>',
                data    :   `idProgramStudi=${idProgramStudi}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Program Studi';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus Program Studi!</span>`;   
                        _onClick    =   function(){
                            _prodiDataTable.draw();
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
