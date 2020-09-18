<!-- GALLERY DETAIL -->
<section id="news-detail" data-stellar-background-ratio="0.5">
    <div class="container">
        <!-- GALLERY THUMB -->
        <div class="gallery-detail-thumb">
            <h3><?php echo $gallery["name"]; ?></h3>
            <p>
                <?php echo $gallery["text"]; ?>
            </p>
            <hr/>
            <div id="lightGallery" class="row">
                <?php if (isset($gallery["gallery_items"]) && $gallery["gallery_items"]["count"] > 0) { ?>
                    <?php foreach ($gallery["gallery_items"]["data"] as $gitem) { ?>
                        <div class="gallery-image light-gallery-item col-lg-4 col-xs-12 col-sm-6 col-md-3"
                             data-imagecid="<?php echo $gitem['idgallery_item']; ?>" 
                             data-src="<?php echo str_replace("public.php/", "", RCMS_URL) . $gitem["image_path"]; ?>" 
                             data-sub-html="<?php echo $gitem["name"] ."<br/>". $gitem["text"]; ?>">
                            <div style="background-image: url('<?php echo str_replace("public.php/", "", RCMS_URL) . $gitem["image_path"]; ?>')" 
                                 class="img-responsive gallery-item-image" 
                                 alt="<?php echo $gitem["name"]; ?>"></div>
                            <p class="gallery-item-text">
                                <i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo " ".$gitem["name"]; ?>
                                <br/>
                                <?php if ($gitem["text"] != '') { ?>
                                    <?php echo " ".$gitem["text"]; ?></span>
                                <?php } else { ?>
                                    <i>nincs leírás</i>
                                <?php } ?>
                            </p>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</section>