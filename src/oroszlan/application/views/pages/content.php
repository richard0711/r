<!-- NEWS DETAIL -->
<section id="news-detail" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row">

            <div class="">
                <!-- NEWS THUMB -->
                <div class="news-detail-thumb">
                    <?php if (isset($content["news_items"]) && $content["news_items"]["count"] > 0) { ?>
                        <div class="news-image">
                            <img src="<?php echo str_replace("public.php/", "", RCMS_URL) . $content["news_items"]["data"][0]["image_path"]; ?>" class="img-responsive" alt="">
                        </div>
                    <?php } ?>
                    <h3><?php echo $content["title"]; ?></h3>
                    <p>
                        <?php echo $content["content"]; ?>
                    </p>
                    <div class="news-social-share">
                        <h4>Ossza meg a cikket</h4>
                        <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>Facebook</a>
                        <a href="#" class="btn btn-success"><i class="fa fa-twitter"></i>Twitter</a>
                        <a href="#" class="btn btn-danger"><i class="fa fa-google-plus"></i>Google+</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>