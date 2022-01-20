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
        $this->load->view(websiteComp('head'), $headOptions);
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="service" class="service-area pt-150 pb-105">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h6 class="sub-title">Langganan</h6>
                            <h4 class="title">
                                <span>Yuk, langganan berita, dan informasi update tentang tempequ, ada penawaran menarik juga lho ...</span>
                            </h4>
                        </div>
                    </div>
                </div>
                <hr />
                <div class='row pt-4'>
                    <div class="col-12">
                        <form id='formLangganan'>
                            <div class="row pb-3">
                                <div class="col-lg-7 pr-2 col-xs-12 col-sm-12 col-md-7">
                                    <input type="text" class='form-control-langganan' placeholder='Nama Lengkap'
                                        name='nama' />
                                </div>
                                <div class="col-lg-5 pl-2 col-xs-12 col-sm-12 col-md-5">
                                    <input type="number" class='form-control-langganan' placeholder='Nomor Telepon'
                                        name='nomorTelepon' />
                                </div>
                            </div>
                            <input type="email" class='form-control-langganan my-3' placeholder='Email anda'
                                name='email' />
                            <hr />
                            <div class="text-center">
                                <button class="main-btn main-btn-2" id="btnSubmit" type='submit'>Langganan</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php
            $javascriptOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/plugins/sweetalert2/sweetalert2.min.js'),
                        base_url('assets/plugins/myJS/delayKeyup.js')
                    ]
                ]
            ];
            $this->load->view(websiteComp('javascript'), $javascriptOptions);  
        ?>
    </body>
</html>
<style type="text/css">
    .form-control-langganan{
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
</style>
<script type="text/javascript">
    $('#formLangganan').on('submit', function(e){
        e.preventDefault();

        let _formData   =   $(this).serialize();

        let _btnSubmit      =   $('#btnSubmit');
        let _btnSubmitText  =   _btnSubmit.text();

        _btnSubmit.prop('disabled', true).text('Processing ...');

        $.ajax({
            url     :   '<?=site_url('langganan/process')?>',
            type    :   'POST',
            data    :   _formData,
            success :   (decodedRFS) => {
                _btnSubmit.prop('disabled', false).text(_btnSubmitText);

                let _status     =   decodedRFS.status;

                let _title  =   'Langganan';
                let _type, _html, _onClick;
                if(_status){
                    let _message    =   `Anda akan menerima notifikasi, update dan berita - berita terbaru dari TempeQu!`;

                    _html   =   `<span class='text-success'>Berhasil <b>berlangganan</b> ! ${_message}</span>`;
                    _type   =   'success';
                    _onClick    =   () => {location.reload()};
                }else{
                    let _message    =   decodedRFS.message;

                    _html   =   `<span class='text-danger'>Gagal <b>berlangganan</b>! ${_message}</span>`;
                    _type   =   'error';
                    _onClick    =   null; 
                }

                notificationSwal(_title, _html, _type, _onClick);
            }
        });
    });
</script>