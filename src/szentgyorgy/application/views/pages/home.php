<section id="szgyholder" class="hidden-xs">
    <div class="container">
        &nbsp;
    </div>
</section>

<!-- ABOUT -->
<?php if (isset($home_page_welcome) && isset($home_page_welcome["data"][0]) ) { ?>
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="about-info">
                    <h2>Szent György Gyógyszertár</h2>
                    <div>
                        <?php echo $home_page_welcome["data"][0]["content"]; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php } ?>

<!-- NEWS -->
<?php if (isset($home_page_news) && $home_page_news["count"] > 0) { ?>
<section id="news" data-stellar-background-ratio="2.5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- SECTION TITLE -->
                <div class="section-title " data-wow-delay="0.1s">
                    <h2>Hírek</h2>
                </div>
            </div>
            <?php $max_count = 4; $news_counter = 0; foreach ($home_page_news["data"] as $new) { if ($max_count == $news_counter) { break; } else { $news_counter++; } ?> 
            <div class="col-md-3 col-sm-6">
                <div class="card-thumb " data-wow-delay="0.2s">
                    <?php if (isset($new["news_items"]) && $new["news_items"]["count"] > 0) { ?>
                        <?php $img = str_replace("public.php/", "", RCMS_URL) . $new["news_items"]["data"][0]["image_path"]; ?>
                    <?php } else { ?> 
                        <?php $img = VIEWS_URL . "images/ujlogo.jpg"; ?>
                    <?php } ?> 
                    <a 
                        style="background-image: url('<?php echo $img; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"
                        class="search-list-item-imglink" href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>">
                    </a>
                    <div class="services-info">
                        <h5><a href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>"><?php echo $new["title"]; ?></a></h5>
                        <p class="search-list-short-desc">
                            <?php echo $new["short_desc"]; ?>
                        </p>
                    </div>
                    <p class="search-list-item-calendar"><i class="fa fa-calendar"></i> <span><?php echo formatted_date_time($new["published"]); ?></span></p>
                </div>
            </div>
            <?php } ?> 
        </div>
    </div>
</section>
<?php } ?>

<!-- extra footer content -->
<?php if (isset($extra_footer_content) && isset($extra_footer_content["data"][0]) ) { ?>
<section id="footer-extra-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about-info">
                    <h2></h2>
                    <div>
                        <?php echo $extra_footer_content["data"][0]["content"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
