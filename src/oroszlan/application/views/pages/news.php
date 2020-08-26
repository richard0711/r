<!-- NEWS DETAIL -->
<section id="news-detail" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-sm-7">
                <!-- NEWS THUMB -->
                <div class="news-detail-thumb">
                    <?php if (isset($news["news_items"]) && $news["news_items"]["count"] > 0) { ?>
                        <div class="news-image">
                            <img src="<?php echo str_replace("public.php/", "", RCMS_URL) . $news["news_items"]["data"][0]["image_path"]; ?>" class="img-responsive" alt="">
                        </div>
                    <?php } ?>
                    <h3><?php echo $news["title"]; ?></h3>
                    <p>
                        <?php echo $news["content"]; ?>
                    </p>
                    <div class="news-social-share">
                        <h4>Ossza meg a cikket</h4>
                        <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>Facebook</a>
                        <a href="#" class="btn btn-success"><i class="fa fa-twitter"></i>Twitter</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-google-plus"></i>Google+</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-5">
                <div class="news-sidebar">
                    <?php if (isset($home_page_news) && $home_page_news["count"] > 1) { ?>
                    <div class="recent-post">
                        <h4>További cikkek</h4>
                        <?php $max_count = 3; $news_counter = 0; foreach ($home_page_news["data"] as $new) { if($new["idnew"] == $news["idnew"]) {continue;}  if ($max_count == $news_counter) { break; } else { $news_counter++; } ?> 
                        <div class="media">
                            <div class="media-object pull-left">
                                <a href="<?php echo FULL_BASE_URL . 'news/'.$new["idnew"]; ?>">
                                    <?php if (isset($new["news_items"]) && $new["news_items"]["count"] > 0) { ?>
                                    <img src="<?php echo str_replace("public.php/", "", RCMS_URL).$new["news_items"]["data"][0]["image_path"]; ?>" class="img-responsive" alt="">
                                    <?php } else { ?>
                                    <!-- NEWS default image -->
                                    <img src="<?php echo VIEWS_URL; ?>images/news-image.jpg" class="img-responsive" alt="">
                                    <?php } ?>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="<?php echo FULL_BASE_URL . 'news/'.$new["idnew"]; ?>"><?php echo $new["title"]; ?></a>
                                    <br/>
                                    <small class="text-muted"><?php echo formatted_date_time($new["published"], false, '', 'hun'); ?></small>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                        <?php } ?>

<!--                    <div class="news-categories">
                        <h4>Categories</h4>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Dental</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Cardiology</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Health</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i> Consultant</a></li>
                    </div>

                    <div class="news-ads sidebar-ads">
                        <h4>Sidebar Banner Ad</h4>
                    </div>

                    <div class="news-tags">
                        <h4>Tags</h4>
                        <li><a href="#">Pregnancy</a></li>
                        <li><a href="#">Health</a></li>
                        <li><a href="#">Consultant</a></li>
                        <li><a href="#">Medical</a></li>
                        <li><a href="#">Doctors</a></li>
                        <li><a href="#">Social</a></li>
                    </div>-->
                </div>
            </div>

        </div>
    </div>
</section>