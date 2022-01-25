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
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('periode/add'))?>">
                                                    <button class="btn btn-link btn-sm">Periode Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelPeriode'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Periode</th>
                                                <th class='border-top-0 text-left text-bold'>Pelaksanaan</th>
                                                <th class='border-top-0 text-left text-bold'>Penilaian</th>
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


    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('periode/listPeriode'))?>${location.search}`,
            dataSrc     :   'listPeriode'
        },
        
        columns     :   [          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='mb-1'>${data.namaPeriode}</h6>
                        <span class='text-muted text-sm'>Tahun ${data.tahunPeriode}</span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<span class='text-muted text-sm'>
                            ${convertDate(data.mulaiPelaksanaan)} <b>s/d</b> ${convertDate(data.akhirPelaksanaan)}
                        </span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<span class='text-muted text-sm'>
                            ${convertDate(data.mulaiPenilaian)} <b>s/d</b> ${convertDate(data.akhirPenilaian)}
                        </span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idPeriode      =   data.idPeriode;
                let _namaPeriodeUC  =   data.namaPeriode.toUpperCase();

                let _actionHTML     =   `<div class='text-center'>
                                            <a href='${_siteURL}${_adminControllers}/periode/edit/${_idPeriode}'>
                                                <span class='fa fa-edit text-warning cp mr-2' data-toggle='tooltip' data-placement='top'
                                                    title='Edit Data Periode ${_namaPeriodeUC}'></span>
                                            </a>
                                            <span class='fa fa-trash text-danger cp' data-toggle='tooltip' data-placement='top'
                                                title='Hapus Data Periode ${_namaPeriodeUC}' onClick='hapusPeriode(this, "${_idPeriode}", "${_namaPeriodeUC}")'></span>
                                        </div>`;

                return `<div class='text-center'>
                            ${_actionHTML}
                        </div>`;
            }}
        ]
    };

    let _periodeDataTable   =   $('#tabelPeriode').DataTable(_dataTableOptions);

    async function hapusPeriode(thisContext, idPeriode, namaPeriode) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus Periode <b class='text-primary'>${namaPeriode}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('periode/process_delete'))?>',
                data    :   `idPeriode=${idPeriode}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Periode';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus Periode!</span>`;   
                        _onClick    =   function(){
                            _periodeDataTable.draw();
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
