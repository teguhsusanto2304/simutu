<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  'List Pelanggan',
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
                    $contentHeaderOptions   =   ['pageName' => 'Langganan'];
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
                                                <h5>Langganan</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <button class="btn btn-sm btn-success excel" scope='all'>Excel All</button>
                                                <button class="btn btn-sm btn-secondary ml-1 excel" scope='onlyShown'>Excel Only Shown</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-sm" id='tabelPelanggan'>
                                            <thead>
                                                <th class='border-top-0 text-center text-bold'>No.</th>
                                                <th class='border-top-0 text-left text-bold'>Nama Pelanggan</th>
                                                <th class='border-top-0 text-left text-bold'>Telepon</th>
                                                <th class="border-top-0 text-left text-bold">Email</th>
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
    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('langganan/listPelanggan'))?>${location.search}`,
            dataSrc     :   'listPelanggan'
        },
        
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                return  `
                                <h6 class='text-primary text-bold mb-0'>
                                    ${data.nama}
                                </h6>
                                <span class='text-muted' style='font-size:.80rem;'>Mendaftar pada <b>${convertDateTime(data.createdAt)}</b></span>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let nomorTeleponHTML    =   `<span class='text-muted text-sm'>${data.telepon}</span>`;

                return  `${nomorTeleponHTML}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let emailHTML    =   `<span class='text-muted text-sm'>${data.email}</span>`;

                return  `${emailHTML}`;
            }}
        ]
    };

    let _pelangganDataTable   =   $('#tabelPelanggan').DataTable(_dataTableOptions);


    $('.excel').on('click', function(e){
        e.preventDefault();

        let _scope  =   $(this).attr('scope');

        let _ajax   =   _pelangganDataTable.ajax;
        let _url    =   _ajax.url();

        let _fullEndpoint;
        if(_scope === 'all'){
            _fullEndpoint   =   `${_url}?exportTo=excel&exportScope=all`;
        }else{
            let _params =   _ajax.params();

            let _stringParams   =   $.param(_params);
            _fullEndpoint       =   `${_url}?${_stringParams}&exportTo=excel`;
        }

        window.open(_fullEndpoint, '_blank');
    });
</script>
