<?php
    $blogOptions    =   [
        'select'    =>  'permalink, title',
        'limit'     =>  5
    ];
    $newestBlogs    =   $this->blog->getBlog(null, $blogOptions);
?>
<footer id="footer" class="footer-area bg_cover" 
    style="background-image: url(<?=base_url('assets/consult/images/footer-bg.jpg')?>); height:auto;">
    <div class="container">
        <div class="footer-widget pt-30 pb-70">
            <div class="row">
                <div class="col-lg-3 col-sm-6 order-sm-1 order-lg-1">
                    <div class="footer-about pt-40">
                        <a href="#">
                            <img src="<?=base_url('assets/img/logo.png')?>" alt="Logo" 
                                style='width:200px;' />
                        </a>
                        <p class="text">
                            TempeQu merupakan usaha mikro yang di produksi oleh Pondok Pesatren Taruna  Al-Qolam yang didirikan pada tahun 2018.
                        </p>
                    </div> <!-- footer about -->
                </div>
                <div class="col-lg-3 col-sm-6 order-sm-3 order-lg-2">
                    <div class="footer-contact pt-40">
                        <div class="footer-title">
                            <h5 class="title">Our Newest Blogs</h5>
                        </div>
                        <div class="contact pt-10">
                            <p class="text">
                                <ul>
                                <?php foreach($newestBlogs as $blog){ ?>
                                    <li class='mb-3'>
                                        <a href="<?=$blog['permalink']?>" target='_blank'>
                                            <?=$blog['title']?>    
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            </p>
                        </div>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-3 col-sm-6 order-sm-4 order-lg-3">
                    <div class="footer-contact pt-40">
                        <div class="footer-title">
                            <h5 class="title">About Us</h5>
                        </div>
                        <div class='contact pt-10'>
                            <p class="text">
                                TempeQu merupakan usaha mikro yang di produksi oleh Pondok Pesatren Taruna  Al-Qolam yang didirikan pada tahun 2018.
                            </p>
                        </div>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-3 col-sm-6 order-sm-2 order-lg-4">
                    <div class="footer-contact pt-40">
                        <div class="footer-title">
                            <h5 class="title">Contact Info</h5>
                        </div>
                        <div class="contact pt-10">
                            <p class="text">Komplek Halat Bisnis Center<br />Jln. Halat No.64B</p>
                            <p class="text">tempequstore@gmail.com</p>
                            <p class="text">0812-6539-7877</p>

                            <ul class="social mt-40">
                                <li>
                                    <a href="https://web.facebook.com/muhammad.falentino.1" target="_blank">
                                        <i class="lni-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://wa.me/6281265397877" target="_blank">
                                        <i class="lni-whatsapp"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/tempequ/" target="_blank">
                                        <i class="lni-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> <!-- contact -->
                    </div> <!-- footer contact -->
                </div>
            </div> <!-- row -->
        </div> <!-- footer widget -->
    </div> <!-- container -->
</footer>