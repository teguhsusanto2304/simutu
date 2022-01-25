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
                                                <h5 class='mb-1'>Penetapan</h5>
                                                <span class="text-muted text-sm">Prodi <b><?=$detailProdi['namaProgramStudi']?></b></span>
                                            </div>
                                            <div class="col-lg-8 text-right">
                                                <a href="<?=site_url(adminControllers('ProgramStudi'))?>">
                                                    <button class="btn btn-link btn-sm">List Prodi</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="formPenetapan">
                                            <div class="row">
                                                <div class="col-lg-12">
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
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class='mb-1'>Dokumen</h5>
                                                            <span class='text-muted text-sm'>Pilih Dokumen</span>
                                                        </div>
                                                        <div class="col">
                                                            <select id='subStandart' name='subStandart' class='form-control'
                                                                onChange='subStandartChanged(this)'>
                                                                <option value=''>Semua Sub Standart</option>
                                                                <?php 
                                                                    if(count($listSubStandart) >= 1){ 
                                                                        foreach($listSubStandart as $subStandart){
                                                                            $isSelected     =   false;

                                                                            if(!is_null($subStandarIdQS)){
                                                                                if(!empty($subStandarIdQS)){
                                                                                    $subStandarIdQS    =   trim($subStandarIdQS);
                                                                                    $isSelected         =   ($subStandarIdQS == $subStandart['subStandarId']);
                                                                                }
                                                                            }        

                                                                            $selected   =   ($isSelected)? 'selected' : '';                                                                    
                                                                            ?>
                                                                            <option value='<?=$subStandart['subStandarId']?>'
                                                                                <?=$selected?>><?=$subStandart['namaSubStandar']?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <input type='text' class='form-control' placeholder='Pencarian'
                                                                id='pencarian' />
                                                        </div>
                                                    </div>
                                                    <hr />
                                                    <?php 
                                                        if(count($indikatorDokumen) >= 1){
                                                    ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-sm" id='tabelIndikatorDokumen'>
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th>Standart</th>
                                                                        <th>Sub Standart</th>
                                                                        <th>Pernyataan</th>
                                                                        <th>Indikator</th>
                                                                        <th>Indikator Dokumen</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($indikatorDokumen as $indikator){ ?>
                                                                    <tr class='indikator-dokumen'>
                                                                        <td>
                                                                            <input type="checkbox" name="indikatorDokumen[]" 
                                                                                value='<?=$indikator['indikatorDokumenId']?>' class='indikatorDokumen' />
                                                                        </td>
                                                                        <td>
                                                                            <h6 class='namaStandar'><?=$indikator['namaStandar']?></h6>
                                                                            <span class='text-sm text-muted kodeStandar'>Kode <b><?=$indikator['kodeStandar']?></b></span>
                                                                        </td>
                                                                        <td>
                                                                            <h6 class='namaSubStandar'><?=$indikator['namaSubStandar']?></h6>
                                                                            <span class='text-sm text-muted kodeSubStandar'>Kode <b><?=$indikator['kodeSubStandar']?></b></span>
                                                                        </td>
                                                                        <td>
                                                                            <h6 class='namaPernyataan'><?=$indikator['namaPernyataan']?></h6>
                                                                            <span class='text-sm text-muted kodePernyataan'>Kode <b><?=$indikator['kodePernyataan']?></b></span>
                                                                        </td>
                                                                        <td>
                                                                            <h6 class='namaIndikator'><?=$indikator['namaIndikator']?></h6>
                                                                            <span class='text-sm text-muted kodeIndikator'>Kode <b><?=$indikator['kodeIndikator']?></b></span>
                                                                        </td>
                                                                        <td class='namaIndikatorDokumen'><?=$indikator['namaIndikatorDokumen']?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php
                                                        }else{
                                                            ?>
                                                                <div class="text-center pt-3 pb-5">
                                                                    <img src="<?=base_url(assetsImg('empty.png'))?>" style='width:150px;' />
                                                                    <h5>Indikator Dokumen</h5>
                                                                    <p class='text-sm text-muted mb-0'>Tidak ada data indikator dokumen</p>
                                                                </div>
                                                            <?php
                                                        }
                                                    ?>
                                                    <button class="btn btn-success mr-1" type='submit'
                                                        id='btnSubmit'>Simpan <?=($detailProdi !== false)? 'Perubahan' : ''?> Program Studi</button>
                                                    <a href="<?=site_url(adminControllers('ProgramStudi'))?>">
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

    $('#periode, #subStandart').select2({
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
            url     :   `<?=site_url(adminControllers('ProgramStudi/process_savePenetapan'))?>`,
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
                        location.href   =   `<?=site_url(adminControllers('ProgramStudi'))?>`;
                    }
                });
            }
        });
    });

    function subStandartChanged(thisContext){
        let _el     =   $(thisContext);

        let _subStandarId  =  _el.val();   
        let _newURL     =   `${_urlAwal}?subStandarId=${_subStandarId}`;

        location.href   =   _newURL;
    }

    let _urlAwal    =   `<?=site_url(adminControllers('ProgramStudi/penetapan/'))?><?=$detailProdi['idprogramstudi']?>`;

    $('#pencarian').on('keyup', function(){
        let _el     =   $(this);

        let _value              =   _el.val();
        let _valueLC            =   _value.toLowerCase();
        let _indikatorDokumen   =   $('.indikator-dokumen');

        for(_i = 0; _i < _indikatorDokumen.length; _i++){
            let _iD             =   $(_indikatorDokumen[_i]);
            
            let _namaStandar    =   _iD.find('.namaStandar').text();
            let _kodeStandar    =   _iD.find('.kodeStandar').text();

            let _namaSubStandar    =   _iD.find('.namaSubStandar').text();
            let _kodeSubStandar    =   _iD.find('.kodeSubStandar').text();

            let _namaPernyataan    =   _iD.find('.namaPernyataan').text();
            let _kodePernyataan    =   _iD.find('.kodePernyataan').text();

            let _namaIndikator    =   _iD.find('.namaIndikator').text();
            let _kodeIndikator    =   _iD.find('.kodeIndikator').text();

            let _namaIndikatorDokumen    =   _iD.find('.namaIndikatorDokumen').text();
            let _kodeIndikatorDokumen    =   _iD.find('.kodeIndikatorDokumen').text();

            if(_namaStandar.toLowerCase().indexOf(_valueLC) >= 0 || _kodeStandar.toLowerCase().indexOf(_valueLC) >= 0
                || _namaSubStandar.toLowerCase().indexOf(_valueLC) >= 0 || _kodeSubStandar.toLowerCase().indexOf(_valueLC) >= 0
                || _namaPernyataan.toLowerCase().indexOf(_valueLC) >= 0 || _kodePernyataan.toLowerCase().indexOf(_valueLC) >= 0
                || _namaIndikator.toLowerCase().indexOf(_valueLC) >= 0 || _kodeIndikator.toLowerCase().indexOf(_valueLC) >= 0
                || _namaIndikatorDokumen.toLowerCase().indexOf(_valueLC) >= 0 || _kodeIndikatorDokumen.toLowerCase().indexOf(_valueLC) >= 0){
                _iD.show();
            }else{
                _iD.hide();
            }
        }
    });
</script>