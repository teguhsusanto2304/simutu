<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarFoto   =   $this->path->uploadGambarFoto;

        $isGaleriExist    =   (count($listGaleri) >= 1);
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="service" class="service-area pt-150 pb-105">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-6">
                        <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h6 class="sub-title">Galeri</h6>
                            <h4 class="title">
                                <span>Yuk kepoin kegiatan kami di sini</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0 mt-md-0 mt-sm-0">
                        <form>
                            <input type="text" class='pencarian' placeholder='Cari Galeri dengan Judul'
                                name='search[value]' value='<?=(isset($_GET['search']['value']))? $_GET['search']['value'] : ''?>' />
                        </form>
                    </div>
                </div>
                <hr />
                <div class='row pt-4' id="listGaleri">
                    <?php 
                        if($isGaleriExist){
                            foreach($listGaleri as $galeriItem){ 
                                $idGaleri   =   $galeriItem['id'];
                                $link       =   site_url('galeri/'.$idGaleri);

                                $getFoto    =   $this->galeri->getFoto($idGaleri);
                                $jumlahFoto =   count($getFoto);
                                $maxJumlahFoto  =   2;
                    ?>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 galeri-item mb-5">
                                <a href="<?=$link?>" target='_blank' class='w-100'>
                                    <img src="<?=base_url($path->uploadGambarGaleri.'/compress/'.$galeriItem['foto'])?>" alt='<?=$galeriItem['judul']?>'
                                        class='w-100 d-block m-auto img-galeri' />
                                </a>
                                <br />
                                <a href="<?=$link?>" target='_blank' class='w-100'>
                                    <h4 class='text-black mt-3'><?=$galeriItem['judul']?></h4>
                                </a>
                                <div class="mb-0 mt-2 col">
                                    <div class="row text-sm text-muted ">
                                        <div class="col pl-0">
                                            <b><?=number_format($jumlahFoto)?> Foto</b>
                                        </div>
                                        <div class="col text-right pr-0">
                                            <?php 
                                                if($jumlahFoto >= 1){
                                                    foreach($getFoto as $indexData => $foto){
                                                        if($indexData < $maxJumlahFoto){
                                                            echo    '<img src="'.base_url($uploadGambarFoto.'/compress/'.$foto['foto']).'" alt="'.$foto['nama'].'" 
                                                                        class="w-25-25 img-circle" style="margin-right:-10px;" 
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="'.$foto['nama'].'" />';
                                                        }
                                                    }
                                                    if($jumlahFoto > $maxJumlahFoto){ 
                                                        echo    '<p class="mb-0">dan '.number_format($jumlahFoto - $maxJumlahFoto).' lainnya</p>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-muted mb-0">
                                    Created <?=date('D, d M Y', strtotime($galeriItem['createdAt']))?>
                                </p>
                            </div>
                    <?php }}else{ ?>
                            <div class='py-4 text-center col'>
                                <img src="<?=base_url('assets/img/empty.png')?>" alt="Tidak Ada Konten" style='width:150px; opacity:.25;' />
                                <p class="text-sm text-muted mb-0">Yah, belum ada <b>berita</b> yang bisa dibaca nih ..</b></p>
                            </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php 
            $jsOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/myJS/dateConverter.js')
                    ]
                ]
            ];
            $this->load->view(websiteComp('javascript'), $jsOptions); 
        ?>
    </body>
</html>
<style>
    .pencarian{
        width: 100%;
        padding: 1rem 1.5rem;
        font-size: 1rem;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 5rem;
        box-shadow: 0 4px 20px #ece8e8;
    }
    .img-galeri{
        height:180px;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgb(38 37 37 / 25%);
    }
    .img-circle{
        border-radius:50%;
    }
</style>
<?php if($isGaleriExist){ ?>
    <script language='Javascript'>
        let _baseURL            =   '<?=base_url()?>';
        let _uploadGambarGaleri   =   '<?=$path->uploadGambarGaleri?>';

        let _drawState      =   1;
        let _lengthState    =   10;
        let _startState     =   _drawState * _lengthState;

        let _isAllLoaded    =   false;

        $(window).on('scroll', function(){  
            if(!_isAllLoaded){
                let _listGaleriHeight =   $('#listGaleri').height();
                let _scrollTop      =   $(window).scrollTop();

                let _30PersenListGaleriHeight =   0.3 *_listGaleriHeight;

                if(_scrollTop >= (_listGaleriHeight - _30PersenListGaleriHeight)){
                    let _selectQS   =    'id, foto, judul, createdBy, createdAt';

                    let _searchQS   =   '';
                    let _urlSP  =   new URLSearchParams(location.search);
                    let _search =   _urlSP.get('search[value]');
                    if(_search != null){
                        _searchQS   =   `&search[value]=${_search}`;
                    }

                    $.ajax({
                        async       :   false,
                        url         :   `<?=site_url(adminControllers('galeri/listGaleri'))?>?start=${_startState}&length=${_lengthState}&draw=${_drawState}&selectQS=${_selectQS}${_searchQS}`,
                        success     :   function(_decodedRFS){
                            let _listGaleri   =   _decodedRFS.listGaleri;

                            if(_listGaleri.length >= 1){
                                _drawGaleri(_listGaleri);

                                _drawState++;
                                _startState =   _drawState * _lengthState;
                            }else{
                                _isAllLoaded    =   true;
                            }
                        }
                    });
                }
            }else{
                console.log('All Data has been loaded!');
            }
        });

        function _drawGaleri(listGaleri){
            let _galeriHTML   =   listGaleri.map(function(galeri, index){

                let _detailCreator  =   galeri.detailCreator;

                let _id             =   galeri.id;
                let _foto           =   galeri.foto;
                let _title          =   galeri.judul;
                let _creatorNama    =   _detailCreator.nama;
                let _createdAt      =   galeri.createdAt;

                let _link           =   `<?=site_url('galeri/')?>${_id}`;

                return  `<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 galeri-item mb-5">
                            <a href="${_link}" target='_blank'>
                                <img src="${_baseURL}${_uploadGambarGaleri}/compress/${_foto}" alt='${_title}'
                                    class='w-100 d-block uploadGambarGaleri m-auto img-galeri' />
                            </a>
                            <br />
                            <a href="${_link}" target='_blank'>
                                <h4 class='text-black mt-3 mb-2'>${_title}</h4>
                            </a>
                            <p class="text-sm text-muted mb-0">
                                Created by ${_creatorNama}, ${convertDateTime(_createdAt)}
                            </p>
                        </div>`;
            });

            $('#listGaleri').append(_galeriHTML);
        }
    </script>
<?php } ?>