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
                </div>
            </div>


        </div>
    </div>
</section>