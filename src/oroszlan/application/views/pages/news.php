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
                        <h4>Ossza meg a hírt</h4>
                        <div class="fb-like" data-href="<?php echo FULL_BASE_URL . 'p/news/' . $news["idnew"]; ?>" data-width="300" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-5">
                <div class="news-sidebar">
                    <?php if (isset($home_page_news) && $home_page_news["count"] > 1) { ?>
                    <div class="recent-post">
                        <h4>További hírek</h4>
                        <?php $max_count = 3; $news_counter = 0; foreach ($home_page_news["data"] as $new) { if($new["idnew"] == $news["idnew"]) {continue;}  if ($max_count == $news_counter) { break; } else { $news_counter++; } ?> 
                        <div class="media">
                            <div class="media-object pull-left">
                                <a href="<?php echo FULL_BASE_URL . 'news/'.$new["idnew"]; ?>">
                                    <div class="media-object pull-left">
                                        <a href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>">
                                            <?php if (isset($new["news_items"]) && $new["news_items"]["count"] > 0) { ?>
                                                <div style="background: url('<?php echo str_replace("public.php/", "", RCMS_URL) . $new["news_items"]["data"][0]["image_path"]; ?>');" class="circle-div" alt=""></div>
                                            <?php } else { ?>
                                                <div style="background: url('<?php echo VIEWS_URL; ?>images/ujlogo.jpg');" class="circle-div" alt=""></div>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="<?php echo FULL_BASE_URL . 'p/news/'.$new["idnew"]; ?>"><?php echo $new["title"]; ?></a>
                                    <br/>
                                    <small class="text-muted"><?php echo formatted_date_time($new["published"], false, '', 'hun'); ?></small>
                                </h4>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                        <?php } ?>
                </div>
            </div>

        </div>
    </div>
</section>