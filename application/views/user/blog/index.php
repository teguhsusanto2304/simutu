<html lang="en">
    <?php 
        $headOptions    =   [
            'pageTitle'     =>  $pageTitle
        ];
        $this->load->view(websiteComp('head'), $headOptions);

        $uploadGambarHero   =   $this->path->uploadGambarHero;

        $isBlogExist    =   (count($listBlog) >= 1);
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
                            <h6 class="sub-title">Blog</h6>
                            <h4 class="title">
                                <span>Dapatkan berita menarik hanya di sini</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-3 mt-lg-0 mt-md-0 mt-sm-0">
                        <form>
                            <input type="text" class='pencarian' placeholder='Cari Blog dengan Judul'
                                name='search[value]' value='<?=(isset($_GET['search']['value']))? $_GET['search']['value'] : ''?>' />
                        </form>
                    </div>
                </div>
                <hr />
                <div class='row pt-4' id="listBlog">
                    <?php 
                        if($isBlogExist){
                            foreach($listBlog as $blogItem){ 
                                $link   =   site_url('read/'.$blogItem['permalink']);
                    ?>
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 blog-item mb-5">
                                <a href="<?=$link?>" target='_blank' class='w-100'>
                                    <img src="<?=base_url($path->uploadGambarBlog.'/compress/'.$blogItem['foto'])?>" alt='<?=$blogItem['title']?>'
                                        class='w-100 d-block m-auto img-blog' />
                                </a>
                                <br />
                                <a href="<?=$link?>" target='_blank' class='w-100'>
                                    <h4 class='text-black mt-3'><?=$blogItem['title']?></h4>
                                </a>
                                <p class="text-sm text-muted mb-0">
                                    Posted <?=date('D, d M Y', strtotime($blogItem['createdAt']))?>
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
</style>
<?php if($isBlogExist){ ?>
    <script language='Javascript'>
        let _baseURL            =   '<?=base_url()?>';
        let _uploadGambarBlog   =   '<?=$path->uploadGambarBlog?>';

        let _drawState      =   1;
        let _lengthState    =   10;
        let _startState     =   _drawState * _lengthState;

        let _isAllLoaded    =   false;

        $(window).on('scroll', function(){  
            if(!_isAllLoaded){
                let _listBlogHeight =   $('#listBlog').height();
                let _scrollTop      =   $(window).scrollTop();

                let _30PersenListBlogHeight =   0.3 *_listBlogHeight;

                if(_scrollTop >= (_listBlogHeight - _30PersenListBlogHeight)){
                    let _selectQS   =    'id, foto, title, permalink, createdBy, createdAt';

                    let _searchQS   =   '';
                    let _urlSP  =   new URLSearchParams(location.search);
                    let _search =   _urlSP.get('search[value]');
                    if(_search != null){
                        _searchQS   =   `&search[value]=${_search}`;
                    }

                    $.ajax({
                        async       :   false,
                        url         :   `<?=site_url(adminControllers('blog/listBlog'))?>?start=${_startState}&length=${_lengthState}&draw=${_drawState}&selectQS=${_selectQS}${_searchQS}`,
                        success     :   function(_decodedRFS){
                            let _listBlog   =   _decodedRFS.listBlog;

                            if(_listBlog.length >= 1){
                                _drawBlog(_listBlog);

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

        function _drawBlog(listBlog){
            let _blogHTML   =   listBlog.map(function(blog, index){

                let _detailCreator  =   blog.detailCreator;

                let _link           =   blog.permalink;
                let _foto           =   blog.foto;
                let _title          =   blog.title;
                let _creatorNama    =   _detailCreator.nama;
                let _createdAt      =   blog.createdAt;

                return  `<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12 blog-item mb-5">
                            <a href="${_link}" target='_blank'>
                                <img src="${_baseURL}${_uploadGambarBlog}/compress/${_foto}" alt='${_title}'
                                    class='w-100 d-block uploadGambarBlog m-auto img-blog' />
                            </a>
                            <br />
                            <a href="${_link}" target='_blank'>
                                <h4 class='text-black mt-3'>${_title}</h4>
                            </a>
                            <p class="text-sm text-muted mb-0">
                                Posted by ${_creatorNama}, ${convertDateTime(_createdAt)}
                            </p>
                        </div>`;
            });

            $('#listBlog').append(_blogHTML);
        }
    </script>
<?php } ?>