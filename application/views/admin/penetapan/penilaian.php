<!DOCTYPE html>
<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
                    base_url('assets/plugins/sweetalert2/sweetalert2.min.css'),
                    base_url('assets/plugins/select2/css/select2.min.css'),
                    base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css')
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
                                        <form id="formPenilaian">
                                            <h5 class='mb-3'>Item (Detail) Penetapan</h5>
                                            <?php 
                                                if(count($listItemPenetapan) >= 1){
                                            ?>
                                                <div class="table-responsive">
                                                    <table class='table table-sm'>
                                                        <thead>
                                                            <tr>
                                                                <th class='text-center' width='5%;'>No.</th>
                                                                <th>Indikator Dokumen</th>
                                                                <th>Catatan & Link </th>
                                                                <th>Penilaian</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                        foreach($listItemPenetapan as $indexData => $penetapan){
                                                            ?>
                                                                <tr>
                                                                    <td class='text-center'><?=$indexData+1?></td>
                                                                    <td>
                                                                        <h6 class='mb-1'><?=$penetapan['namaIndikatorDokumen']?></h6>
                                                                        <span class='text-sm text-muted'><?=$penetapan['kodeIndikator']?></span>
                                                                    </td>
                                                                    <td>
                                                                        <h6 class='mb-1'><?=$penetapan['catatan']?></h6>
                                                                        <span class='text-sm text-muted'><?=$penetapan['linkProdi']?></span>
                                                                    </td>
                                                                    <td class='vam'>
                                                                        <input type="hidden" name="idPenetapanDetail[]" class='idPenetapanDetail form-control'
                                                                            value='<?=$penetapan['penetapanDetailId']?>' />
                                                                        <select name="penilaian[]" class='penilaian form-control'>
                                                                            <option value=''>Pilih Penilaian</option>
                                                                            <?php foreach($listPenilaian as $penilaian){ ?>
                                                                                <option value='<?=$penilaian['idPenilaian']?>'><?=$penilaian['namaPenilaian']?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </td>
                                                                    <td class='vam'>
                                                                        <textarea name="keterangan[]" class='keterangan form-control'
                                                                            placeholder='Keterangan'></textarea>
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
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/select2/js/select2.min.js')
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

    $('.penilaian').select2({theme : 'bootstrap4'});

    $('#formPenilaian').on('submit', function(e){
        e.preventDefault();

        let _penilaian          =   $('.penilaian').serialize();
        let _keterangan         =   $('.keterangan').serialize();
        let _idPenetapanDetail  =   $('.idPenetapanDetail').serialize();
        let _data       =   `${_idPenetapanDetail}&${_penilaian}&${_keterangan}&idPenetapan=${_idPenetapan}`;

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');
        $.ajax({
            url     :   `<?=site_url(adminControllers('penetapan/process_setPenilaian'))?>`,
            type    :   'POST',
            data    :   _data,
            success     : function(decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave   =   decodedRFS.statusSave;

                let _title  =   `Penilaian`;
                let _html, _type;
                if(_statusSave){
                    _html   =   `<span class='text-success'>Berhasil melakukan penilaian!</span>`;
                    _type   =   'success';
                }else{
                    let _messageSave   =  decodedRFS.messageSave;
                    _html   =   `<span class='text-danger'>Gagal melakukan penilaian! ${_messageSave}</span>`;
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
