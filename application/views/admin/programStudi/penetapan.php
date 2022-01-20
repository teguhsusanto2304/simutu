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
                    $contentHeaderOptions   =   ['pageName' => 'Penetapan'];
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
                                                <h5>Penetapan</h5>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('programstudi'))?>">
                                                    <button class="btn btn-link btn-sm">List Prodi</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formPenetapan">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <table class="table table-sm">
                                                                <tr>
                                                                    <td>Nama Program Studi</td>
                                                                    <td><?=$detailProdi['namaProgramStudi']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kode Jurusan</td>
                                                                    <td><?=$detailProdi['jurusanKode']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kode Program Studi</td>
                                                                    <td><?=$detailProdi['programStudiCode']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Didirikan</td>
                                                                    <td><?=$detailProdi['tglBerdiri']?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-6">
                                                            <table class="table table-sm">
                                                                <tr>
                                                                    <td>Peringkat Akreditasi</td>
                                                                    <td><?=$detailProdi['peringkatAkreditasi']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>NO SK Prodi</td>
                                                                    <td><?=$detailProdi['numberSK']?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>SK BAN PT</td>
                                                                    <td><?=$detailProdi['noSKBANPT']?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <hr class='mb-4' />
                                                    <h5>Periode</h5>
                                                    <select id='periode' class='form-control' name='periode'>
                                                        <option value=''>Pilih Periode</option>
                                                        <?php
                                                            if(count($listPeriode) >= 1){
                                                                foreach($listPeriode as $periode){
                                                                    ?>
                                                                        <option value='<?=$periode['idPeriode']?>'><?=$periode['namaPeriode']?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                    <hr class='mb-4' />
                                                    <h5>Dokumen</h5>
                                                    <?php 
                                                        if(count($indikatorDokumen) >= 1){
                                                    ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-sm">
                                                                <?php foreach($indikatorDokumen as $indikator){ ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" name="indikatorDokumen[]" 
                                                                                value='<?=$indikator['indikatorDokumenId']?>' class='indikatorDokumen' />
                                                                        </td>
                                                                        <td><?=$indikator['namaIndikatorDokumen']?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                    <?php
                                                        }
                                                    ?>
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailProdi !== false)? 'Perubahan' : ''?> Program Studi</button>
                                                    <a href="<?=site_url(adminControllers('programstudi'))?>">
                                                        <button class="btn btn-default ml-1" type='button'>Back to List Program Studi</button>
                                                    </a>
                                                </div>
                                            </div>
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
<script src="<?=base_url('assets/plugins/ckfinder_php_3.5.2/ckfinder/ckfinder.js')?>"></script>
<script language='Javascript'>
    let baseURL             =   '<?=base_url()?>';

    let imgPreview  =   false;
    let imgData     =   false;

    $('#periode').select2({
        theme    : "bootstrap4", 
    });

    $('#formPenetapan').on('submit', function(e){
        e.preventDefault();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');

        let _indikatorDokumen   =   $('.indikatorDokumen').serialize();
        let _idProdi    =   `<?=$detailProdi['idprogramstudi']?>`;
        let _idPeriode  =   $('#periode').val();

        let _formData   =   `${_indikatorDokumen}&idProdi=${_idProdi}&periode=${_idPeriode}`;

        $.ajax({
            url     :   `<?=site_url(adminControllers('programstudi/process_savePenetapan'))?>`,
            type    :   'POST',
            data    :   _formData,
            success     :   function(_decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSave     =   _decodedRFS.statusSave;

                let _swalType, _swalMessage;

                if(_statusSave){
                    _swalMessage    =   'Berhasil menyimpan Penetapan!';
                    _swalType       =   'success';
                }else{
                    let _messageSave    =   _decodedRFS.messageSave;
                    _swalMessage    =   `Gagal menyimpan Penetapan! ${_messageSave}`;
                    _swalType       =   'error';
                }

                Swal.fire({
                    title   :   'Penetapan',
                    html    :   _swalMessage,
                    icon    :   _swalType
                }).then(() => {
                    if(_statusSave){
                        location.href   =   `<?=site_url(adminControllers('programstudi'))?>`;
                    }
                });
            }
        });
    });
</script>