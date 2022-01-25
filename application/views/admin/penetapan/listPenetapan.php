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
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelPenetapan'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Pelaksana/Penilai</th>
                                                <th class='border-top-0 text-left text-bold'>Standart/Sub/Perny.</th>
                                                <th class='border-top-0 text-left text-bold'>Ind./Ind. Dok.</th>
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

    let _loadedFrom                 =   `<?=$loadedFrom?>`;
    let _loadedFrom_pelaksanaan     =   `<?=$loadedFrom_pelaksanaan?>`;
    let _loadedFrom_penilaian       =   `<?=$loadedFrom_penilaian?>`;

    let _pelaksanaQS    =   `<?=($detailUser['role'] == 9)? '&kps='.$this->isUserLoggedIn : ''?>`;   
    let _auditorQS      =   `<?=($detailUser['role'] == 3)? '&auditor='.$this->isUserLoggedIn : ''?>`;   

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('penetapan/listPenetapan?joinWithProdiAndPeriode=true&loadedFrom='.$loadedFrom))?>${_auditorQS}${_pelaksanaQS}${location.search}`,
            dataSrc     :   'listPenetapan'
        },
        
        columns     :   [          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},        
            {data : null, render : function(data, type, row, metaData){
                let _pelaksanaHTML  =   `<b class='text-danger'>Belum Dilaksanakan</b>`;

                if(data.pelaksanaan !== null && data.pelaksanaan !== undefined){
                    let _pelaksanaan  =   data.pelaksanaan;
                    _pelaksanaHTML  =   `<h6 class='text-bold mb-0'>
                                            ${_pelaksanaan.namaPelaksana}
                                        </h6>
                                        <span class='text-muted text-sm'>Dilaksanakan pada <b>${convertDateTime(data.waktuPelaksanaan)}</b></span>`;
                }

                let _penilaiHTML    =   `<p class='mt-3 mb-0'><b class='text-danger'>Belum dinilai</b></p>`;
                if(data.penilaian !== null && data.penilaian !== undefined){
                    let _penilaian    =   data.penilaian;
                    _penilaiHTML    =   `<br />
                                        <br />
                                        <h6 class='text-bold mb-0'>
                                            ${_penilaian.namaPenilai}
                                        </h6>
                                        <p class='text-muted text-sm mb-0'>Dinilai pada <b>${convertDateTime(data.waktuPenilaian)}</b></p>`;
                }

                return  `${_pelaksanaHTML}${_penilaiHTML}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaStandar}
                        </h6>
                        <span class='text-muted text-sm'>Pada <b>${data.kodeStandar}</b></span>
                        <br />
                        <br />
                        <h6 class='text-bold mb-0'>
                            ${data.namaSubStandar}
                        </h6>
                        <p class='text-muted text-sm mb-0'>Kode Sub <b>${data.kodeSubStandar}</b></p>
                        <span class='text-muted text-sm'>
                            Link contoh <b><a href='${data.linkStandarSPMI}' target='_blank'><span class='fa fa-link'></span></a></b>
                        </span>
                        <br />
                        <br />
                        <h6 class='text-bold mb-0'>
                            ${data.namaPernyataan}
                        </h6>
                        <span class='text-muted text-sm'>Kode Perny. <b>${data.kodePernyataan}</b></span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaIndikator}
                        </h6>
                        <span class='text-muted text-sm'>Kode Ind. <b>${data.kodeIndikator}</b></span>
                        <br />
                        <br />
                        <h6 class='text-bold mb-0'>
                            ${data.namaIndikatorDokumen}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaProgramStudi}
                        </h6>
                        <span class='text-muted text-sm'>${data.programStudiCode}</span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaPeriode}
                        </h6>
                        <span class='text-muted text-sm'>
                            Pelaksanaan <b>${convertDate(data.mulaiPelaksanaan, ' ', true)} s/d ${convertDate(data.akhirPelaksanaan, ' ', true)}<b/>
                        </span>
                        `;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idPenetapan      =   data.penetapanId;

                //default _actionHTML adalah pengesetan/penetapan auditor
                let _actionHTML =   `<div class='text-center'>
                                        <a href='${_siteURL}${_adminControllers}/penetapan/setAuditor/${_idPenetapan}'
                                            data-toggle='tooltip' title='Set Auditor' data-placement='top'>
                                            <span class='fa fa-user text-warning'></a>
                                        </a>
                                    </div>`;

                if(_loadedFrom === _loadedFrom_pelaksanaan){
                    _actionHTML     =   `<div class='text-center'>
                                            <a href='${_siteURL}${_adminControllers}/penetapan/pelaksanaan/${_idPenetapan}'
                                                data-toggle='tooltip' title='Set Pelaksanaan' data-placement='top'>
                                                <span class='fa fa-edit text-warning'></a>
                                            </a>
                                        </div>`;
                }
                if(_loadedFrom === _loadedFrom_penilaian){
                    _actionHTML     =   `<div class='text-center'>
                                            <a href='${_siteURL}${_adminControllers}/penetapan/penilaian/${_idPenetapan}'
                                                data-toggle='tooltip' title='Set Penilaian' data-placement='top'>
                                                <span class='fa fa-edit text-success'></a>
                                            </a>
                                        </div>`;
                }

                return `<div class='text-center'>
                            ${_actionHTML}
                        </div>`;
            }}
        ]
    };

    let _prodiDataTable   =   $('#tabelPenetapan').DataTable(_dataTableOptions);
</script>
