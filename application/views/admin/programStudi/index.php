<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Program Studi',
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
                    $contentHeaderOptions   =   ['pageName' => 'Program Studi'];
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
                                                <h5>Program Studi</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('programstudi/add'))?>">
                                                    <button class="btn btn-link btn-sm">Standart Baru</button>
                                                </a>
                                            </div>
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

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('programstudi/listProgramStudi'))?>${location.search}`,
            dataSrc     :   'listProgramStudi'
        },
        
        columns     :   [
        //pT.programStudiCode, pT.namaProgramStudi, pT.numberSK, pT.peringkatAkreditasi, pT.noSKBANPT
          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.programStudiCode}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.namaProgramStudi}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.numberSK}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.peringkatAkreditasi}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.noSKBANPT}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idProdi          =   data.idprogramstudi;
                let _namaProdiUC      =   data.namaProgramStudi.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/programstudi/edit/${_idProdi}'>
                                <span class='fa fa-edit text-warning cp' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Program Studi ${_namaProdiUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp mx-3' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Program Studi ${_namaProdiUC}' onClick='hapusProdi(this, "${_idProdi}", "${_namaProdiUC}")'></span>
                            <a href='${_siteURL}${_adminControllers}/programstudi/penetapan/${_idProdi}'>
                                <span class='fa fa-check text-success cp' data-toggle='tooltip' data-placement='top'
                                    title='Penetapan Program Studi ${_namaProdiUC}' onClick='penetapanProdi(this, "${_idProdi}", "${_namaProdiUC}")'></span>
                            </a>
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
                url     :   '<?=site_url(adminControllers('programstudi/process_delete'))?>',
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