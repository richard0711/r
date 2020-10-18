<?php if (isset($news_list) && $news_list["count"] > 0) { ?>
    <section data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="text-center">
                        <h3 class="wow fadeInUp" data-wow-delay="0.1s">Aktualitások</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php foreach ($news_list["data"] as $new) { ?>
                    <div style="margin-top: 20px;" class="col-md-4 col-sm-6">
                        <div class="card-thumb wow fadeInUp" data-wow-delay="0.2s">
                            <?php if (isset($new["gallery_items"]) && $new["gallery_items"]["count"] > 0) { ?>
                                <?php $img = str_replace("public.php/", "", RCMS_URL) . $new["gallery_items"]["data"][0]["image_path"]; ?>
                            <?php } else { ?> 
                                <?php $img = VIEWS_URL . "images/ujlogo.jpg"; ?>
                            <?php } ?> 
                            <a 
                                style="background-image: url('<?php echo $img; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"
                                class="search-list-item-imglink" href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>">
                            </a>
                            <div class="services-info">
                                <h3><a href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>"><?php echo $new["title"]; ?></a></h3>
                                <p class="search-list-short-desc">
                                    <?php echo $new["short_desc"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>
