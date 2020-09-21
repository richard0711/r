<!-- CONTENT DETAIL -->
<section id="news-detail" data-stellar-background-ratio="0.5">
    <div class="container">
        <!-- CONTENT THUMB -->
        <div class="news-detail-thumb">
            <?php if (isset($content["content_items"]) && $content["content_items"]["count"] > 0) { ?>
                <div class="news-image">
                    <img src="<?php echo str_replace("public.php/", "", RCMS_URL) . $content["content_items"]["data"][0]["image_path"]; ?>" class="img-responsive" alt="">
                </div>
            <?php } ?>
            <h3><?php echo $content["title"]; ?></h3>
            <p>
                <?php echo $content["content"]; ?>
            </p>
            <div class="news-social-share">
                <h4>Ossza meg a cikket</h4>
                <a href="#" class="btn btn-primary"><i class="fa fa-facebook"></i>Facebook</a>
<!--                <div class="fb-like" 
                    data-href="https://www.your-domain.com/your-page.html" 
                    data-width=""
                    data-layout="standard" 
                    data-action="like" 
                    data-size="small"  
                    data-share="true">
               </div>-->
            </div>
        </div>
    </div>
</section>