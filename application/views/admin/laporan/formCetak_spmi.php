<!DOCTYPE html>
<html lang="en">
    <?php 
        $spmi   =   $this->laporan->laporan_spmi;

        $headOptions    =   [
            'pageTitle'     =>  $pageTitle,
            'morePackages'  =>  [
                'css'   =>  [
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
                                                <h5><?=$pageTitle?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive">
                                       <form id="formCetak_spmi" method='post' action="<?=site_url(adminControllers('laporan/prosesCetak/'.$spmi))?>">
                                            <div class="row">
                                                <div class="form-group col-lg-2">
                                                    <label for='standar'>Standar</label>
                                                    <select id='standar' class='form-control' name='standar'
                                                        data-url='<?=site_url(adminControllers('spmi/SubStandart/listSubStandart'))?>'
                                                        data-select='kodeSubStandar, namaSubStandar'
                                                        data-where-column='kodeStandar'
                                                        data-index-data='listSubStandart'
                                                        data-option-text='namaSubStandar'
                                                        data-option-value='kodeSubStandar'
                                                        onChange='_loadItem(this, "#subStandar")'>
                                                       <option value=''>Semua Standar</option>
                                                       <?php 
                                                            if(count($listStandart) >= 1){
                                                                foreach($listStandart as $standart){
                                                                    ?>
                                                                        <option value='<?=$standart['kodeStandar']?>'><?=$standart['namaStandar']?></option>
                                                                    <?php
                                                                }
                                                            }
                                                       ?>
                                                   </select>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label for='subStandar'>Sub Standar</label>
                                                    <select id='subStandar' class='form-control' name='subStandar'
                                                        data-url='<?=site_url(adminControllers('spmi/Pernyataan/listPernyataan'))?>'
                                                        data-select='kodePernyataan, namaPernyataan'
                                                        data-where-column='kodeSubStandar'
                                                        data-index-data='listPernyataan'
                                                        data-option-text='namaPernyataan'
                                                        data-option-value='kodePernyataan'
                                                        onChange='_loadItem(this, "#pernyataan")'>
                                                       <option value=''>Semua Sub Standar</option>
                                                       
                                                   </select>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <label for='pernyataan'>Pernyataan</label>
                                                    <select id='pernyataan' class='form-control' name='pernyataan'
                                                        data-url='<?=site_url(adminControllers('spmi/Indikator/listIndikator'))?>'
                                                        data-select='kodeIndikator, namaIndikator'
                                                        data-where-column='kodePernyataan'
                                                        data-index-data='listIndikator'
                                                        data-option-text='namaIndikator'
                                                        data-option-value='kodeIndikator'
                                                        onChange='_loadItem(this, "#indikator")'>
                                                       <option value=''>Semua Pernyataan</option>
                                                       
                                                   </select>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label for='indikator'>Indikator</label>
                                                    <select id='indikator' class='form-control' name='indikator'
                                                        data-url='<?=site_url(adminControllers('spmi/IndikatorDokumen/listIndikatorDokumen'))?>'
                                                        data-select='indikatorDokumenId, namaIndikatorDokumen'
                                                        data-where-column='kodeIndikator'
                                                        data-index-data='listIndikatorDokumen'
                                                        data-option-text='namaIndikatorDokumen'
                                                        data-option-value='indikatorDokumenId'
                                                        onChange='_loadItem(this, "#indikatorDokumen")'>
                                                       <option value=''>Semua Indikator</option>
                                                       
                                                   </select>
                                                </div>
                                                <div class="form-group col-lg-3">
                                                    <label for='indikatorDokumen'>Indikator Dokumen</label>
                                                    <select id='indikatorDokumen' class='form-control' name='indikatorDokumen'>
                                                       <option value=''>Semua Indikator Dokumen</option>
                                                       
                                                   </select>
                                                </div>
                                            </div>
                                            <hr />
                                            <button class='btn btn-success' type='submit'>Cetak Laporan</button>
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
                        base_url('assets/plugins/select2/js/select2.min.js')
                    ]
                ]
            ];
            $this->load->view(adminComponents('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<script type="text/javascript">
    $('select').select2({theme : 'bootstrap4'});

    function _loadItem(thisContext, itemElement){
        let _el         =   $(thisContext);
        let _itemEl     =   $(itemElement);

        let _value  =   _el.val();

        let _url            =   _el.data('url');
        let _select         =   _el.data('select');
        let _whereColumn    =   _el.data('whereColumn');
        let _indexData      =   _el.data('indexData');

        let _optionText     =   _el.data('optionText');
        let _optionValue    =   _el.data('optionValue');

        let _where  =   `{"${_whereColumn}" : "${_value}"}`;

        $.ajax({
            url     :   _url,
            data    :   `select=${_select}&where=${_where}&noLimit=true`,
            success     :   function(decodedRFS){
                let _data   =   decodedRFS[_indexData];

                let _html   =   `<option value=''>Semua Data</option>`;
                _html       +=  _data.map((dataItem, indexDataItem) => {
                    return  `<option value="${dataItem[_optionValue]}">${dataItem[_optionText]}</option>`;
                });
                _itemEl.html(_html);
            } 
        });
    }
</script>