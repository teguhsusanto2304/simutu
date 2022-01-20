<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle
        ];
        $this->load->view(websiteComp('head'), $headOptions);
        
        $isFAQExist =   (count($listFAQ) >= 1);
    ?>
    <body>
        <?php $this->load->view(websiteComp('preloader')); ?>
        
        <header class="header-area">
            <?php $this->load->view(websiteComp('navbar')); ?>
        </header>

        <section id="faq" class="service-area pt-150 pb-75">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="section-title wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.2s">
                            <h6 class="sub-title">
                                FAQ
                            </h6>
                            <h4 class="title">
                                <span>Pertanyaan</span> yang <span>sering ditanyakan</span>
                            </h4>
                        </div>
                    </div>
                </div> <!-- row -->
                <hr />
                <?php if($isFAQExist){ ?>
                    <div id="listFAQ">
                    <?php foreach($listFAQ as $faq){ ?>
                        <div class="card mb-3 cp">
                            <div class="card-header py-4" id="heading-<?=$faq['id']?>" data-toggle="collapse" 
                                data-target="#collapse-<?=$faq['id']?>" aria-expanded="false"
                                aria-controls="collapse-<?=$faq['id']?>" style='border-color:#28a745;'>
                                
                                    <h6 class="collapsed text-success">
                                        <?=$faq['title']?>
                                    </h6>
                                
                            </div>
                            <div id="collapse-<?=$faq['id']?>" class="collapse" 
                                aria-labelledby="heading-<?=$faq['id']?>" data-parent="#listFAQ">
                                <div class="card-body">
                                    <?=$faq['content']?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>    
                    </div>
                <?php }else{ ?>
                    <div class='py-4 text-center col'>
                        <img src="<?=base_url('assets/img/empty.png')?>" alt="FAQ Tidak Ada" style='width:150px; opacity:.25;' />
                        <p class="text-sm text-muted mb-0">Yah, belum ada <b>Pertanyaan</b> yang sering ditanya nih ..</b></p>
                    </div>
                <?php } ?>
            </div> <!-- container -->
        </section>

        <?php $this->load->view(websiteComp('footer')); ?>
        <?php 
            $jsOptions  =   [
                'morePackages'  =>  [
                    'js'    =>  [
                        base_url('assets/consult/js/bootstrap.min.js'),
                        base_url('assets/consult/js/popper.min.js')
                    ]
                ]
            ];
            $this->load->view(websiteComp('javascript'), $jsOptions); 
        ?>
    </body>
</html>

<?php if($isFAQExist){ ?>
    <script language='Javascript'>
        let _baseURL            =   '<?=base_url()?>';

        let _drawState      =   1;
        let _lengthState    =   10;
        let _startState     =   _drawState * _lengthState;

        let _isAllLoaded    =   false;

        $(window).on('scroll', function(){  
            if(!_isAllLoaded){
                let _listFAQHeight  =   $('#listFAQ').height();
                let _scrollTop      =   $(window).scrollTop();

                let _30PersenlistFAQHeight =   0.3 *_listFAQHeight;

                if(_scrollTop >= (_listFAQHeight - _30PersenlistFAQHeight)){
                    let _selectQS   =    'id, title, content';

                    let _searchQS   =   '';
                    let _urlSP  =   new URLSearchParams(location.search);
                    let _search =   _urlSP.get('search[value]');
                    if(_search != null){
                        _searchQS   =   `&search[value]=${_search}`;
                    }

                    $.ajax({
                        async       :   false,
                        url         :   `<?=site_url(adminControllers('faq/listFAQ'))?>?start=${_startState}&length=${_lengthState}&draw=${_drawState}&select=${_selectQS}${_searchQS}`,
                        success     :   function(_decodedRFS){
                            let _listFAQ   =   _decodedRFS.listFAQ;

                            if(_listFAQ.length >= 1){
                                _drawFAQ(_listFAQ);

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

        function _drawFAQ(listFAQ){
            let _faqHTML    =   listFAQ.map(function(faq, index){
                console.log(faq);
                let _idFAQ  =   faq.id;
                let _title  =   faq.title;
                let _content    =   faq.content;

                return  `<div class="card mb-3 cp">
                            <div class="card-header py-4" id="heading-${_idFAQ}" data-toggle="collapse" 
                                data-target="#collapse-${_idFAQ}" aria-expanded="false"
                                aria-controls="collapse-${_idFAQ}" style='border-color:#28a745;'>
                                
                                    <h6 class="collapsed text-success">
                                        ${_title}
                                    </h6>
                                
                            </div>
                            <div id="collapse-${_idFAQ}" class="collapse" 
                                aria-labelledby="heading-${_idFAQ}" data-parent="#listFAQ">
                                <div class="card-body">
                                    ${_content}
                                </div>
                            </div>
                        </div>`;
            });

            $('#listFAQ').append(_faqHTML);
        }
    </script>
<?php } ?>