<!DOCTYPE html>
<html lang="en">
    <?php 
        $path           =   $this->path;

        $addNewHTML     =   '<a href="'.site_url(adminControllers('foto/add')).'">
                                <button class="btn btn-link">Add New Foto</button>
                            </a>';

        $dGS    =   (isset($detailGaleri));
        if($dGS){
            $dG     =   $detailGaleri;

            $addNewHTML     =   '<a href="'.site_url(adminControllers('galeri/addFoto/'.$dG['id'])).'">
                                    <button class="btn btn-link">Add New Foto to This Galery</button>
                                </a>';
        }
        

        $uploadGambarGaleri =   $this->path->uploadGambarGaleri;

        $headOptions    =   [
            'pageTitle'     =>  'List Foto Galeri',
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
                    $contentHeaderOptions   =   ['pageName' => 'List Foto Galeri'];
                    if($dGS){
                        $contentHeaderOptions['pageNameSubTitle']   =   'Galeri <b>'.$dG['judul'].'</b>';
                    }
                    $this->load->view(adminComponents('content-header'), $contentHeaderOptions); 
                ?>
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class='card-header'>
                                        <div class="row">
                                            <?php if($dGS){ ?>
                                                <img src='<?=base_url($uploadGambarGaleri.'/compress/'.$dG['foto'])?>' alt='<?=$dG['judul']?>'
                                                    class='w-50-50 img-circle' />
                                            <?php } ?>
                                            <div class='col <?=($dGS)? 'pl-3' : ''?>'>
                                                <h5 class='mb-0'>List Foto Galeri</h5>
                                                <?php if($dGS){ ?>
                                                    <span class="text-sm text-muted"><?=$dG['judul']?></span>
                                                <?php } ?>
                                            </div>
                                            <div class='col text-right'>
                                                <?=$addNewHTML?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-body'>
                                        <div class="table-responsive">
                                            <table class="table table-sm table-striped" id='tabelFoto'>
                                                <thead>
                                                    <tr>
                                                        <td class='text-center'>No.</td>
                                                        <td class='text-left'>Galeri</td>
                                                        <td class='text-left'>Foto</td>
                                                        <td class='text-left'>Updater</td>
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
    let _uploadGambarFoto           =   '<?=$path->uploadGambarFoto?>';
    let _uploadGambarGaleri         =   '<?=$path->uploadGambarGaleri?>';
    let _uploadGambarAdmin          =   '<?=$path->uploadGambarAdmin?>';

    let _select     =   `select=id, idGaleri, nama, foto, keterangan, createdBy, createdAt, updatedBy, updatedAt`;
    let _where      =   ``;

    let _dGS    =   `<?=($dGS)?>`;
    _dGS        =   (_dGS == true);

    let idGaleri    =   '<?=($dGS)? $dG['id'] : '' ?>';

    if(_dGS){
        let _condition          =   {idGaleri};
        let _encodedCondition   =   JSON.stringify(_condition);   
        _where  =   `&where=${_encodedCondition}`;
    }

    let _dataTableOptions   =  {
        processing  :   true,
        serverSide  :   true,
        ajax    :   {
            url         :   `<?=base_url(adminControllers('foto/listFoto?'))?>${_select}${_where}${location.search}`,
            dataSrc     :   'listFoto'
        },
        columns     :   [
            {data : null, render : function(data, type, row, metaData){
                return  `<p class='text-bold text-center'>
                            ${metaData.row + 1}.
                        </p>`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailCreator    =   data.detailCreator;
                let _adminHTML;

                if(_detailCreator !== false){
                    _adminHTML  =   `<div class='row'>
                                        <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailCreator.foto}' alt='Foto ${_detailCreator.nama}' 
                                            class='img-circle w-25-25' />
                                        <span class='text-sm text-muted ml-2'>Didaftarkan oleh <b>${_detailCreator.nama}</b></span>
                                    </div>`;
                }else{
                    _adminHTML  =   `<i class='text-sm text-muted'>Creator tidak dikenal!</i>`;
                }

                let _detailGaleri   =   data.detailGaleri;
                let _galeriHTML;

                if(_detailGaleri !== false){
                    _galeriHTML     =   `<div class='row'>
                                            <img src='${_baseURL}/${_uploadGambarGaleri}/compress/${_detailGaleri.foto}' alt='Foto ${_detailGaleri.judul}' 
                                                class='img-circle w-50-50' />
                                            <div class='col pl-3'>
                                                <h6 class='text-primary text-bold mb-1'>
                                                    ${_detailGaleri.judul}
                                                </h6>
                                                ${_adminHTML}
                                            </div>
                                        </div>`;
                }else{
                    _galeriHTML     =   `<i class='text-sm text-muted'>Galeri Tidak Diketahui</i>`;
                }

                return  `${_galeriHTML}`;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailCreator    =   data.detailCreator;
                let _adminHTML;

                if(_detailCreator !== false){
                    _adminHTML  =   `<div class='row'>
                                        <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailCreator.foto}' alt='Foto ${_detailCreator.nama}' 
                                            class='img-circle w-25-25' />
                                        <span class='text-sm text-muted ml-2'>Didaftarkan oleh <b>${_detailCreator.nama}</b></span>
                                    </div>`;
                }else{
                    _adminHTML  =   `<i class='text-sm text-muted'>Creator tidak dikenal!</i>`;
                }

                let _keterangan =   data.keterangan;
                if(_keterangan.length >= 50){
                    _keterangan     =   _keterangan.substring(0, 50);
                    _keterangan     =   `${_keterangan} ...`;
                }

                return  `<div class='row'>
                            <img src='${_baseURL}/${_uploadGambarFoto}/compress/${data.foto}' alt='Foto ${data.nama}' 
                                class='img-circle w-50-50' />
                            <div class='col pl-3'>
                                <h6 class='text-primary text-bold mb-0'>
                                    ${data.nama}
                                </h6>
                                <p class='mb-1 text-sm text-muted'>${_keterangan}</p>
                                ${_adminHTML}
                            </div>
                        </div>
                        `;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _detailUpdater  =   data.detailUpdater;
                let _updaterHTML;

                if(_detailUpdater === null){
                    _updaterHTML    =   `<i class='text-sm text-muted'>Belum pernah diupdate !</i>`;
                }else{
                    if(_updaterHTML !== false){
                        let _updateTime =   convertDateTime(data.updatedAt);
                        _updaterHTML    =   `<div class='row'>
                                                <img src='${_baseURL}/${_uploadGambarAdmin}/compress/${_detailUpdater.foto}' alt='Foto ${_detailUpdater.nama}' 
                                                    class='img-circle w-50-50' />
                                                <div class='col pl-3'>
                                                    <h6 class='text-primary text-bold mb-0'>
                                                        ${_detailUpdater.nama}
                                                    </h6>
                                                    <span class='text-sm text-muted'>Pada <b>${_updateTime}</b></span>
                                                </div>
                                            </div>`;
                    }else{
                        _updaterHTML    =   `<i class='text-sm text-muted'>Updater tidak terdaftar !</i>`;
                    }
                }
                return  _updaterHTML;
            }},
            {data : null, render : function(data, type, row, metaData){
                let _idFoto     =   data.id;
                let _namaFotoUC =   data.nama.toUpperCase();

                return `<div class='text-center'>
                            <a href='${_siteURL}${_adminControllers}/foto/edit/${_idFoto}'>
                                <span class='fa fa-edit text-warning cp mr-1' data-toggle='tooltip' data-placement='top'
                                    title='Edit Data Foto ${_namaFotoUC}'></span>
                            </a>
                            <span class='fa fa-trash text-danger cp ml-1' data-toggle='tooltip' data-placement='top'
                                title='Hapus Data Foto ${_namaFotoUC}' onClick='hapusFoto(this, "${_idFoto}", "${_namaFotoUC}")'></span>
                        </div>
                        `;
            }}
        ]
    };

    let _fotoDataTable   =   $('#tabelFoto').DataTable(_dataTableOptions);

    async function hapusFoto(thisContext, idFoto, namaFoto) {
        let _el                 =   $(thisContext);

        let _title          =   'Konfirmasi Hapus';
        let _htmlMessage    =   `Apakah anda yakin akan menghapus foto <b class='text-primary'>${namaFoto}</b> ?`;
        let _confirm        =   await confirmSwal(_title, _htmlMessage);
        
        if(_confirm){
            $.ajax({
                url     :   '<?=site_url(adminControllers('foto/process_delete'))?>',
                data    :   `idFoto=${idFoto}`,
                type    :   'POST',
                success :   (decodedRFS) => {
                    let _statusHapus    =   decodedRFS.statusHapus;
                    
                    let _title  =   'Hapus Foto';
                    let _icon, _message, _onClick;
                    if(_statusHapus){
                        _icon       =   'success';
                        _message    =   `<span class='text-success'>Berhasil menghapus foto!</span>`;   
                        _onClick    =   function(){
                            _fotoDataTable.draw();
                        };
                    }else{
                        let _messageHapus   =   decodedRFS.messageHapus;

                        _icon       =   'error';
                        _message    =   `<span class='text-danger'>Gagal menghapus foto! ${_messageHapus}</span>`;
                        _onClick    =   null;
                    }

                    notificationSwal(_title, _message, _icon, _onClick);
                }
            });
        }
    }
</script>