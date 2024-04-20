<!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container">
        <div class="row">

            <div class="col-md-4 col-sm-4">
                <div class="footer-thumb"> 
                    <h4 data-wow-delay="0.4s">Elérhetőségeink</h4>
                    <div class="contact-info">
                        <p><i class="fa fa-phone"></i> (53) 351 014</p>
                        <p><i class="fa fa-envelope-o"></i> <a href="#" style="color: #000;">gyorgypatika@gmail.com</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4"> 
                <div class="footer-thumb"> 
                    <h4 data-wow-delay="0.4s">Hírek</h4>
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
                        <h4 data-wow-delay="0.4s">Nyitvatartás</h4>
                        <p>Hétfőtől - Péntekig <span>08:00 - 18:00</span></p>
                        <p>Szombat <span>ZÁRVA</span></p>
                        <p>Vasárnap <span>ZÁRVA</span></p>
                    </div> 

                    <ul class="social-icon">
                        <li><a href="https://www.facebook.com/Szent-Gy%C3%B6rgy-Gy%C3%B3gyszert%C3%A1r-Nagyk%C5%91r%C3%B6s-988153384692287" class="fa fa-facebook-square" attr="facebook icon"></a></li>
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
                        <a href="#top" class="smoothScroll " data-wow-delay="1.2s"><i class="fa fa-angle-up"></i></a>
                    </div>
                </div>   
            </div>

        </div>
    </div>
</footer>