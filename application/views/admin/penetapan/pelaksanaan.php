<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
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
                                                <h5 class='mb-1'><?=$pageTitle?></h5>
                                                <span class="text-sm text-muted">Penetapan #<?=$detailPenetapan['penetapanid']?></span>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('penetapan'))?>">
                                                    <button class="btn btn-link btn-sm">List Penetapan</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <form id="formPelaksanaan">
                                            <h5 class='mb-3'>Item (Detail) Penetapan</h5>
                                            <?php 
                                                if(count($listItemPenetapan) >= 1){
                                            ?>
                                                <div class="table-responsive">
                                                    <table class='table table-sm'>
                                                        <thead>
                                                            <tr>
                                                                <th class='text-center' width='5%;'>No.</th>
                                                                <th width='25%;'>Standart/Sub/Perny.</th>
                                                                <th width='25%'>Indikator / Indikator Dokumen</th>
                                                                <th>Link Prodi</th>
                                                                <th>Catatan (Opsional)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                        foreach($listItemPenetapan as $indexData => $penetapan){
                                                            ?>
                                                                <tr>
                                                                    <td class='text-center'><?=$indexData+1?></td>
                                                                    <td>
                                                                        <h6 class='mb-2'><?=$penetapan['namaStandar']?></h6>
                                                                        <p class='text-sm text-muted mb-0'>Kode Standar <b><?=$penetapan['kodeStandar']?></b></p>
                                                                        <br />
                                                                        <h6 class='mb-2'><?=$penetapan['namaSubStandar']?></h6>
                                                                        <p class='text-sm text-muted mb-0'>Kode Sub <b><?=$penetapan['kodeSubStandar']?></b></p>
                                                                        <p class='text-sm text-muted mb-0'>
                                                                            Link contoh <b><a href='<?=$penetapan['linkStandarSPMI']?>' 
                                                                                target='_blank'><span class='fa fa-link'></span></a></b>
                                                                        </p>
                                                                        <br />
                                                                        <h6 class='mb-2'><?=$penetapan['namaPernyataan']?></h6>
                                                                        <p class='text-sm text-muted mb-0'>Kode <b><?=$penetapan['kodePernyataan']?></b></p>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class='mb-2'><?=$penetapan['namaIndikatorDokumen']?></h6>
                                                                        <p class='text-sm text-muted mb-0'>Nama Indikator <b><?=$penetapan['namaIndikator']?></b></p>
                                                                        <span class='text-sm text-muted'>Kode Indikator <b><?=$penetapan['kodeIndikator']?></b></span>
                                                                    </td>
                                                                    <td class='vam'>
                                                                        <input type="hidden" name="idPenetapanDetail[]" class='idPenetapanDetail form-control'
                                                                            value='<?=$penetapan['penetapanDetailId']?>' />
                                                                        <input type="text" name="linkProdi[]" class='linkProdi form-control'
                                                                            placeholder='Link Prodi' />
                                                                    </td>
                                                                    <td class='vam'>
                                                                        <textarea name="catatan[]" class='catatan form-control'
                                                                            placeholder='Catatan (Opsional)'></textarea>
                                                                    </td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                            <hr />
                                            <button class="btn btn-success" type='submit' id='btnSubmit'>Simpan</button>
                                            <a href="<?=site_url(adminControllers('penetapan'))?>">
                                                <button class="ml-2 btn btn-default" type='button'>List Penetapan</button>
                                            </a>
                                        </form>
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

    let _idPenetapan    =   `<?=$detailPenetapan['penetapanid']?>`;

    $('#formPelaksanaan').on('submit', function(e){
        e.preventDefault();

        let _catatan            =   $('.catatan').serialize();
        let _linkProdi          =   $('.linkProdi').serialize();
        let _idPenetapanDetail  =   $('.idPenetapanDetail').serialize();
        let _data       =   `idPenetapan=${_idPenetapan}&${_idPenetapanDetail}&${_catatan}&${_linkProdi}`;

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');
        $.ajax({
            url     :   `<?=site_url(adminControllers('penetapan/process_setPelaksanaan'))?>`,
            type    :   'POST',
            data    :   _data,
            success     : function(decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave   =   decodedRFS.statusSave;

                let _title  =   `Pelaksanaan`;
                let _html, _type;
                if(_statusSave){
                    _html   =   `<span class='text-success'>Berhasil melakukan pelaksanaan!</span>`;
                    _type   =   'success';
                }else{
                    let _messageSave   =  decodedRFS.messageSave;
                    _html   =   `<span class='text-danger'>Gagal melakukan pelaksanaan! ${_messageSave}</span>`;
                    _type   =   'error';
                }

                Swal.fire({
                    title   :   _title,
                    html    :   _html,
                    icon    :   _type
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('penetapan'))?>`;
                    }
                });
            }
        });
    });
</script>
