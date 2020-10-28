<!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="footer-thumb"> 
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Elérhetőségeink</h4>
                    <p>A hét minden napján állunk rendelkezésükre.</p>

                    <div class="contact-info">
                        <p><i class="fa fa-phone"></i> (53) 350 182</p>
                        <p><i class="fa fa-envelope-o"></i> <a href="#" style="color: #000;">orogytar@gmail.com</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4"> 
                <div class="footer-thumb"> 
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Aktualitások</h4>
                    <?php if (isset($home_page_news) && $home_page_news["count"] > 0) { ?>
                    <?php $max_count = 2; $news_counter = 0; foreach ($home_page_news["data"] as $new) { if ($max_count == $news_counter) { break; } else { $news_counter++; } ?> 
                    <div class="latest-stories">
                        <div class="stories-image">
                            <a href="<?php echo FULL_BASE_URL . 'p/news/'.$new["idnew"]; ?>">
                                <?php if (isset($new["news_items"]) && $new["news_items"]["count"] > 0) { ?>
                                <div style="background: url('<?php echo str_replace("public.php/", "", RCMS_URL).$new["news_items"]["data"][0]["image_path"]; ?>');" class="footer-circle-div" alt=""></div>
                                <?php } else { ?>
                                <!-- NEWS default image -->
                                <div style="background: url('<?php echo VIEWS_URL; ?>images/ujlogo.jpg');" class="footer-circle-div" alt=""></div>
                                <?php } ?>
                            </a>
                        </div>
                        <div class="stories-info">
                            <a href="<?php echo FULL_BASE_URL . 'p/news/'.$new["idnew"]; ?>"><h5><?php echo $new["title"]; ?></h5></a>
                            <span><?php echo formatted_date_time($new["published"], false, '', 'hun'); ?></span>
                            <!--2020. Augusztus 10.-->
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <div class="col-md-4 col-sm-4"> 
                <div class="footer-thumb">
                    <div class="opening-hours">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Nyitvatartás</h4>
                        <p>Hétfőtől - Péntekig <span>07:30 - 18:30</span></p>
                        <p>Szombat <span>08:00 - 12:00</span></p>
                        <p>Vasárnap <span>08:00 - 10:00</span></p>
                    </div> 

                    <ul class="social-icon">
                        <li><a href="https://www.facebook.com/oroszlannagykoros" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                        <!--<li><a href="#" class="fa fa-twitter"></a></li>-->
                        <li><a href="https://www.instagram.com/oroszlannagykoros/" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-12 col-sm-12 border-top">
                <div class="col-md-4 col-sm-6">
                   
                </div>
                <div class="col-md-6 col-sm-6">
                   
                </div>
                <div class="col-md-2 col-sm-2 text-align-center">
                    <div class="angle-up-btn">  
                        <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                    </div>
                </div>   
            </div>

        </div>
    </div>
</footer>