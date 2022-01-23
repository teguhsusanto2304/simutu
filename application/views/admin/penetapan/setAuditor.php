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
                                        <h5>Detail Prodi</h5>
                                        <div class="row">
                                            <div class="col-6">
                                                <table class="table table-sm no-border">
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
                                                <table class="table table-sm no-border">
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
                                        <form id="formPenetapanAuditor">
                                            <h5 class='mb-3'>Pilih Auditor</h5>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <?php 
                                                        if(count($listAuditor) >= 1){
                                                            foreach($listAuditor as $auditor){
                                                                ?>
                                                                   <div class="col-lg-3">
                                                                        <div class='row'>
                                                                            <input type='checkbox' value='<?=$auditor['userid']?>' id='<?=$auditor['userid']?>' name='auditor[]'
                                                                                class='auditor' style='margin-top:5px;' />
                                                                            <div class='col mt-0 pl-3'>
                                                                                <label for='<?=$auditor['userid']?>' class='cp'>
                                                                                    <h5 class='mb-1'><?=$auditor['fullName']?></h5>
                                                                                    <p class="text-sm text-muted mb-0"><?=$auditor['namaProgramStudi']?></p>
                                                                                    <span class='text-sm text-muted'>Kode <?=$auditor['programStudiCode']?></span>       
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                   </div>
                                                                <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                            </div>
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

    $('#formPenetapanAuditor').on('submit', function(e){
        e.preventDefault();

        let _auditors   =   $('.auditor').serialize();   
        let _data       =   `idPenetapan=${_idPenetapan}&${_auditors}`;

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();
        
        _btnSubmit.prop('disabled', true).text('Processing ...');
        $.ajax({
            url     :   `<?=site_url(adminControllers('penetapan/process_setAuditor'))?>`,
            type    :   'POST',
            data    :   _data,
            success     : function(decodedRFS){
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _statusSetAuditor   =   decodedRFS.statusSetAuditor;

                let _title  =   `Penetapan Auditor`;
                let _html, _type;
                if(_statusSetAuditor){
                    _html   =   `<span class='text-success'>Berhasil set auditor!</span>`;
                    _type   =   'success';
                }else{
                    let _messageSetAuditor   =  decodedRFS.messageSetAuditor;
                    _html   =   `<span class='text-danger'>Gagal set auditor! ${_messageSetAuditor}</span>`;
                    _type   =   'error';
                }

                Swal.fire({
                    title   :   _title,
                    html    :   _html,
                    icon    :   _type
                }).then(() => {
                    if(_statusSetAuditor){
                        location.href   =   `<?=site_url(adminControllers('penetapan'))?>`;
                    }
                });
            }
        });
    });
</script>
