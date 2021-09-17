<!DOCTYPE html>
<html lang="en">
    <?php 
        $idKonten       =   $detailKonten['id'];
        $namaDivisi     =   $detailKonten['namaDivisi'];
        
        $headOptions    =   [
            'pageTitle'     =>  'Detail Konten '.$namaDivisi,
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
                    $contentHeaderOptions   =   ['pageName' => 'Detail Konten'];
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class='card-header'>
                                        <div class="row">
                                            <div class='col'>
                                                <h5 class='mb-0'>Detail Konten</h5>
                                                <p class='text-sm text-muted mb-0'><?=$namaDivisi?></p> 
                                            </div>
                                            <div class='col text-right'>
                                                <a href="<?=site_url(adminControllers('konten/addItem/'.$idKonten))?>">
                                                    <button class="btn btn-link">Add New Konten Item</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped" id='tabelKontenItem'>
                                                <thead>
                                                    <tr>
                                                        <td class='text-center'>No.</td>
                                                        <td class='text-left'>Konten Item</td>
                                                        <td class='text-left'>Harga</td>
                                                        <td class='text-left'>Deskripsi</td>
                                                        <td class='text-center'>Opsi</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
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
                        base_url('assets/plugins/numeral/numeral.js')
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

    let _idKonten   =   '<?=$idKonten?>';

    let _uploadGambarKontenItem     =   '<?=$this->path->uploadGambarKontenItem?>';
    let _uploadGambarAdmin          =   '<?=$this->path->uploadGambarAdmin?>';

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('KontenItem/listKontenItem/'))?>${_idKonten}${location.search}`,
            dataSrc     :   'dataKontenItem'
        },
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailAdmin    =   data.detailAdmin;
                let _adminHTML;

                if(_detailAdmin !== false){
                    _adminHTML  =   `<div class='row'>
                                        <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailAdmin.foto}' alt='Foto ${_detailAdmin.nama}' 
                                            class='img-circle w-25-25' />
                                        <span class='text-sm text-muted ml-2'>Didaftarkan oleh ${_detailAdmin.nama}</span>
                                    </div>`;
                }else{
                    _adminHTML  =   `<i class='text-sm text-muted'>Didaftarkan oleh Admin tidak dikenal!</i>`;
                }

                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarKontenItem}/compress/${data.foto}' alt='Foto ${data.nama}' 
                                class='img-circle w-50-50' />
                            <div class='col pl-3'>
                                <h6 class='text-primary text-bold mb-1'>
                                    ${data.nama}
                                </h6>
                                <p class='mb-2 text-sm text-muted'><span class='fa fa-star text-warning mr-2'></span><b>${data.rating}</b></p>
                                ${_adminHTML}
                            </div>
                        </div>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _harga      =   data.harga;
                let _diskon     =   data.diskon;

                let _hargaBersih    =   _harga - _diskon;

                let _isAnyDiskon    =   (_diskon >= 1);

                let _hargaHTML;
                if(_isAnyDiskon){
                    let _persentaseDiskon   =   _diskon / _hargaBersih * 100;

                    _hargaHTML  =   `<h5 class='text-success mb-0'>Rp. ${numeral(_hargaBersih).format('0,0')} <span class='ml-1 badge badge-warning text-sm'>FREE ${_persentaseDiskon.toFixed(2)}%</span></h5>
                                    <span class='text-muted text-sm'><strike>Rp. ${numeral(_harga).format('0,0')}</strike></span>
                                    `;
                }else{
                    _hargaHTML  =   `Rp. ${numeral(_harga).format('0,0')}`;
                }

                return  _hargaHTML;   
            }},
            {data : null, render : function(data, type, row, metaData){
                let _deskripsi  =   data.deskripsi;
                if(_deskripsi.length >= 100){
                    _deskripsi  =   _deskripsi.substring(0, 100);
                    _deskripsi  =   `${_deskripsi} ...`;
                }
                return  `${_deskripsi}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idKontenItem   =   data.id;
                let _nama           =   data.nama.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/konten/editItem/${_idKonten}/${_idKontenItem}'>
                                <span class='fa fa-edit text-warning cp mr-1' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Konten Item ${_nama}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp ml-1' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Konten Item ${_nama}' onClick='hapusKontenItem(this, "${_idKontenItem}", "${_nama}")'></span>
                        </div>
                        `;
            }}
        ]
    };

    let _kontenItemDataTable   =   $('#tabelKontenItem').DataTable(_dataTableOptions);
    
    async function hapusKontenItem(thisContext, idKontenItem, namaKontenItem) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus konten item <b class='text-primary'>${namaKontenItem}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('KontenItem/process_delete'))?>',
                data    :   `idKontenItem=${idKontenItem}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapusKontenItem    =   decodedRFS.statusHapusKontenItem;
                    
                    let _title  =   'Hapus Konten Item';
                    let _icon, _message, _onClick;
                    if(_statusHapusKontenItem){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus konten item!</span>`;   
                        _onClick    =   function(){
                            _kontenItemDataTable.draw();
                        };
                    }else{
                        let _messageHapusKontenItem   =   decodedRFS.messageHapusKontenItem;

                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>${_messageHapusKontenItem}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>
