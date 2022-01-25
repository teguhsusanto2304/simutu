<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Sub Standart',
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
                    $contentHeaderOptions   =   ['pageName' => 'Sub Standart'];
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
                                                <h5>Sub Standart</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('spmi/SubStandart/add'))?>">
                                                    <button class="btn btn-link btn-sm">Standart Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelSubStandart'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Kode</th>
                                                <th class='border-top-0 text-left text-bold'>Nama</th>
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
            url         :   `<?=base_url(adminControllers('spmi/SubStandart/listSubStandart'))?>${location.search}`,
            dataSrc     :   'listSubStandart'
        },
        
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.kodeSubStandar}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _link   =   data.linkStandarSPMI;

                return  `<h6 class='text-bold mb-0'>
                            ${data.namaSubStandar}
                        </h6>
                        <a href='${_link}' target='_blank'>
                            <span class='fa fa-link'></span>
                        </a>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idSubStandart         =   data.subStandarId;
                let _namaSubStandartUC    =   data.namaSubStandar.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/spmi/SubStandart/edit/${_idSubStandart}'>
                                <span class='fa fa-edit text-warning cp mr-2' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Sub Standart ${_namaSubStandartUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Sub Standart ${_namaSubStandartUC}' onClick='hapusSubStandart(this, "${_idSubStandart}", "${_namaSubStandartUC}")'></span>
                        </div>`;
            }}
        ]
    };

    let _subStandartDataTable   =   $('#tabelSubStandart').DataTable(_dataTableOptions);

    async function hapusSubStandart(thisContext, idSubStandart, judulStandart) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus sub standart <b class='text-primary'>${judulStandart}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('spmi/SubStandart/process_delete'))?>',
                data    :   `idSubStandart=${idSubStandart}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Hapus Standart';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus sub standart!</span>`;   
                        _onClick    =   function(){
                            _subStandartDataTable.draw();
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
