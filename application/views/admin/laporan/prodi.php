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
                                                <a href="<?=site_url(adminControllers('laporan/formCetak/prodi'))?>">Cetak PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelProdi'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Prodi</th>
                                                <th class='border-top-0 text-left text-bold'>Auditor</th>
                                                <th class='border-top-0 text-left text-bold'>Periode</th>
                                                <th class='border-top-0 text-left text-bold'>Indikator Dokumen</th>
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
    async function getDocs(id) {
    //let url = '<?=base_url()?>assets/doc.json';
    let url   = '<?=base_url(adminControllers('laporan/listProdiDocument'))?>/'+id
    try {
        let res = await fetch(url);
        return await res.json();
    } catch (error) {
        console.log(error);
    }
}

async function renderDocs(id) {
    let users = await getDocs(id);
    let html = '<table>';
        html += '<tr><th>Dokumen</th><th>Status</th><th>Bobot</th><th>Catatan</th></tr>';
    users.forEach(user => {
        let htmlSegment = `<tr><td><h6 class='mb-0'>
                            ${user.doc}
                        </h6></td><td>${user.status}</td><td>${user.penilaian}</td><td>${user.catatan}</td></tr>`;

        html += htmlSegment;
    });
    html += '</ol>';
    let container = document.querySelector('.doc'+id);
    container.innerHTML = html;
    return html;
}
    let _baseURL                    =   `<?=base_url()?>`;
    let _siteURL                    =   `<?=site_url()?>`;
    let _adminControllers           =   `<?=adminControllers()?>`;
    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('laporan/listProdi'))?>${location.search}`,
            dataSrc     :   'listProdi'
        },
        
        columns     :   [          
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaProgramStudi}
                        </h6>
                        <span class='text-muted text-sm'>${data.programStudiCode}</span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.auditorName}
                        </h6>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `<h6 class='text-bold mb-0'>
                            ${data.namaPeriode}
                        </h6>
                        <span class='text-muted text-sm'>${data.tahunPeriode}</span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                renderDocs(data.penetapanId);
                return  `<div class='doc${data.penetapanId}'></div>`;
            }}
        ]
    };

    let _prodiDataTable   =   $('#tabelProdi').DataTable(_dataTableOptions);
</script>
