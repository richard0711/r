<?php if (isset($search_list) && $search_list["news"]["count"] > 0) { ?>
    <section data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="text-center">
                        <h3 class="wow fadeInUp" data-wow-delay="0.1s">Megtalált aktualitások a keresett kifejezés alapján: "<?php echo $search_string; ?>"</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php foreach ($search_list["news"]["data"] as $new) { ?>
                    <div style="margin-top: 20px;" class="col-md-4 col-sm-6">
                        <div class="card-thumb wow fadeInUp" data-wow-delay="0.2s">
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
                                <h3><a href="<?php echo FULL_BASE_URL . 'p/news/' . $new["idnew"]; ?>"><?php echo $new["title"]; ?></a></h3>
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
<?php if (isset($search_list) && $search_list["contents"]["count"] > 0) { ?>

    <section data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="text-center">
                        <h3 class="wow fadeInUp" data-wow-delay="0.1s">Megtalált cikkek a keresett kifejezés alapján: "<?php echo $search_string; ?>"</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php foreach ($search_list["contents"]["data"] as $content) { ?>
                    <div style="margin-top: 20px;" class="col-md-4 col-sm-6">
                        <div class="card-thumb wow fadeInUp" data-wow-delay="0.2s">
                            <?php if (isset($content["content_items"]) && $content["content_items"]["count"] > 0) { ?>
                                <?php $img = str_replace("public.php/", "", RCMS_URL) . $content["content_items"]["data"][0]["image_path"]; ?>
                            <?php } else { ?> 
                                <?php $img = VIEWS_URL . "images/ujlogo.jpg"; ?>
                            <?php } ?> 
                            <a 
                                style="background-image: url('<?php echo $img; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"
                                class="search-list-item-imglink" href="<?php echo FULL_BASE_URL . 'p/content/' . $content["idcontent"]; ?>">
                            </a>
                            <div class="services-info">
                                <h3><a href="<?php echo FULL_BASE_URL . 'p/content/' . $content["idcontent"]; ?>"><?php echo $content["title"]; ?></a></h3>
                                <p class="search-list-short-desc">
                                    <?php echo $content["short_desc"]; ?>
                                </p>
                            </div>
                            <p class="search-list-item-calendar"><i class="fa fa-calendar"></i> <span><?php echo formatted_date_time($content["published"]); ?></span></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (isset($search_list) && $search_list["gallery"]["count"] > 0) { ?>

    <section data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="text-center">
                        <h3 class="wow fadeInUp" data-wow-delay="0.1s">Megtalált galériák a keresett kifejezés alapján: "<?php echo $search_string; ?>"</h3>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php foreach ($search_list["gallery"]["data"] as $gallery) { ?>
                    <div style="margin-top: 20px;" class="col-md-4 col-sm-6">
                        <div class="card-thumb wow fadeInUp" data-wow-delay="0.2s">
                            <?php if (isset($gallery["gallery_items"]) && $gallery["gallery_items"]["count"] > 0) { ?>
                                <?php $img = str_replace("public.php/", "", RCMS_URL) . $gallery["gallery_items"]["data"][0]["image_path"]; ?>
                            <?php } else { ?> 
                                <?php $img = VIEWS_URL . "images/ujlogo.jpg"; ?>
                            <?php } ?> 
                            <a 
                                style="background-image: url('<?php echo $img; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center;"
                                class="search-list-item-imglink" href="<?php echo FULL_BASE_URL . 'p/gallery/' . $gallery["idgallery"]; ?>">
                            </a>
                            <div class="services-info">
                                <h3><a href="<?php echo FULL_BASE_URL . 'p/gallery/' . $gallery["idgallery"]; ?>"><?php echo $gallery["name"]; ?></a></h3>
                                <p class="search-list-short-desc">
                                    <?php echo $gallery["text"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>

<?php if (isset($search_list) && $search_list["contents"]["count"] == 0 && $search_list["news"]["count"] == 0 && $search_list["gallery"]["count"] == 0) { ?>
    <section id="services" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <div class="about-info">
                        <h2 class="wow fadeInUp text-warning" data-wow-delay="0.1s">Nem található, amit keresett!</h2>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>   
<?php } ?>
