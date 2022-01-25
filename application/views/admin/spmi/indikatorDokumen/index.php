<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Indikator Dokumen',
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
                    $contentHeaderOptions   =   ['pageName' => 'Indikator Dokumen'];
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
                                                <h5>Indikator Dokumen</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/IndikatorDokumen/add'))?>">
                                                    <button class="btn btn-link btn-sm">Indikator Dokumen Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='indikatorDokumenTable'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Standart</th>
                                                <th class='border-top-0 text-left text-bold'>Sub Standart</th>
                                                <th class='border-top-0 text-left text-bold'>Pernyataan</th>
                                                <th class='border-top-0 text-left text-bold'>Indikator</th>
                                                <th class='border-top-0 text-left text-bold'>Indikator Dok.</th>
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
            url         :   `<?=base_url(adminControllers('spmi/IndikatorDokumen/listIndikatorDokumen?withStandart=true'))?>${location.search}`,
            dataSrc     :   'listIndikatorDokumen'
        },
        
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaStandar}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _link   =   data.linkStandarSPMI;

                return  `<h6 class='text-bold mb-0'>
                            ${data.namaSubStandar}
                        </h6>
                        <p class='text-sm text-muted mb-0'>
                            <a href='${_link}' target='_blank'>
                                <span class='fa fa-link'></span>
                            </a>
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaPernyataan}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaIndikator}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaIndikatorDokumen}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let idIndikatorDokumen          =   data.indikatorDokumenId;
                let _namaIndikatorDokumenUC    =   data.namaIndikatorDokumen.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/spmi/IndikatorDokumen/edit/${idIndikatorDokumen}'>
                                <span class='fa fa-edit text-warning cp mr-2' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Indikator ${_namaIndikatorDokumenUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Indikator ${_namaIndikatorDokumenUC}' onClick='hapusIndikatorDokumen(this, "${idIndikatorDokumen}", "${_namaIndikatorDokumenUC}")'></span>
                        </div>`;
            }}
        ]
    };

    let _indikatorDokumenDataTable   =   $('#indikatorDokumenTable').DataTable(_dataTableOptions);

    async function hapusIndikatorDokumen(thisContext, idIndikatorDokumen, judulStandart) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus Indikator Dokumen <b class='text-primary'>${judulStandart}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('spmi/IndikatorDokumen/process_delete'))?>',
                data    :   `idIndikatorDokumen=${idIndikatorDokumen}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Indikator Dokumen';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus Indikator Dokumen!</span>`;   
                        _onClick    =   function(){
                            _indikatorDokumenDataTable.draw();
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
