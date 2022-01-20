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
                                                <a href="<?=site_url(adminControllers('programstudi/add'))?>">
                                                    <button class="btn btn-link btn-sm">Standart Baru</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelPenetapan'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Prodi</th>
                                                <th class='border-top-0 text-left text-bold'>Periode</th>
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
            url         :   `<?=base_url(adminControllers('penetapan/listPenetapan?joinWithProdiAndPeriode=true'))?>${location.search}`,
            dataSrc     :   'listPenetapan'
        },
        
        columns     :   [          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.programStudiCode}
                        </h6>
                        <span class='text-muted text-sm'>${data.namaProgramStudi}</span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-primary text-bold mb-0'>
                            ${data.namaPeriode}
                        </h6>
                        <span class='text-muted text-sm'>${convertDate(data.mulaiPelaksanaan, ' ', true)} s/d ${convertDate(data.akhirPelaksanaan, ' ', true)}</span>
                        `;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idPenetapan      =   data.penetapanid;

                let _actionHTML =   `<div class='text-center'>
                                        <a href='${_siteURL}/${_adminControllers}/penetapan/setAuditor/${_idPenetapan}'>
                                            <span class='fa fa-user text-warning'></a>
                                        </a>
                                    </div>`;

                return `<div class='text-center'>
                            ${_actionHTML}
                        </div>`;
            }}
        ]
    };

    let _prodiDataTable   =   $('#tabelPenetapan').DataTable(_dataTableOptions);
</script>
