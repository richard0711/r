<!-- HOME -->
<?php if (isset($home_page_banners) && count($home_page_banners["data"]) > 0) { ?>
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="owl-carousel owl-theme">
                    <?php foreach ($home_page_banners["data"] as $banner) { ?>
                        <?php foreach ($banner["banner_items"]["data"] as $banner_item) { ?>
                            <?php if ($banner_item["image_path"] != null && $banner_item["image_path"] != '') { ?>
                                <div class="item" style="background-image: url('<?php echo str_replace("public.php/", "", RCMS_URL) . $banner_item["image_path"]; ?>');">
                                <?php } else { ?>    
                                    <div class="item" style="background-image: url('<?php echo VIEWS_URL; ?>images/slider2.jpg');">    
                                    <?php } ?>    
                                    <div class="caption">
                                        <?php if ($banner_item["text"] != '') { ?> 
                                        <div onclick="openLink('<?php echo FULL_BASE_URL . 'p/content/'.$banner_item["idcontent"]; ?>');" style="background-color: rgba(95, 93, 94, 0.39); padding: 5px; border-radius: 10px;" class="col-md-offset-1 col-md-10">
                                            <h1><?php echo $banner_item["name"] ?></h1>
                                            <h3><?php echo $banner_item["text"] ?></h3>
                                            <br/>
                                            <?php if ($banner_item["url"] != null && $banner_item["url"] != '') { ?>
                                                <a href="<?php echo $banner_item["url"] ?>" class="section-btn btn btn-default smoothScroll">Megtekintés</a>
                                            <?php } else if ($banner_item["idcontent"] > 1) { ?>
                                                <a href="<?php echo FULL_BASE_URL . 'p/content/'.$banner_item["idcontent"]; ?>" class="section-btn btn btn-default smoothScroll hidden-xs hidden-sm">Megtekintés</a>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>


<!-- ABOUT -->
<?php if (isset($home_page_welcome) && isset($home_page_welcome["data"][0]) ) { ?>
<section id="about">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <div class="about-info">
                    <h2 class="wow fadeInUp" data-wow-delay="0.6s">Oroszlán Gyógyszertár</h2>
                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <?php echo $home_page_welcome["data"][0]["short_desc"]; ?>
                    </div>
                    <figure class="profile wow fadeInUp" data-wow-delay="1s">
                         <br/>
                        <a href="<?php echo FULL_BASE_URL . 'p/content/'.$home_page_welcome["data"][0]["idcontent"]; ?>" class="section-btn btn btn-default smoothScroll">Megtekintés</a>
                    </figure>
                </div>
            </div>

        </div>
    </div>
</section>
<?php } ?>


<!-- SERVICES -->
<?php if (isset($home_page_doctors) && $home_page_doctors["count"] > 0) { ?>
<section id="services" data-stellar-background-ratio="1">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- SECTION TITLE -->
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Szolgáltatások</h2>
                </div>
            </div>
            <div class="clearfix"></div>
            <?php foreach ($home_page_doctors["data"] as $content) { ?>
            <div class="col-md-4 col-sm-6">
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


<!-- NEWS -->
<?php if (isset($home_page_news) && $home_page_news["count"] > 0) { ?>
<section id="news" data-stellar-background-ratio="2.5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- SECTION TITLE -->
                <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                    <h2>Aktualitások</h2>
                </div>
            </div>
            <?php $max_count = 3; $news_counter = 0; foreach ($home_page_news["data"] as $new) { if ($max_count == $news_counter) { break; } else { $news_counter++; } ?> 
            <div class="col-md-4 col-sm-6">
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


<!-- MAKE AN APPOINTMENT -->
<section id="appointment" data-stellar-background-ratio="3">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <img src="<?php echo VIEWS_URL; ?>images/appointment-image.jpg" class="img-responsive" alt="">
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- CONTACT FORM HERE -->
                <form id="appointment-form" role="form" method="post">

                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                        <h2>Lépjen kapcsolatba velünk</h2>
                    </div>

                    <div class="wow fadeInUp" data-wow-delay="0.8s">
                        <div class="col-md-6 col-sm-6">
                            <label for="name">Név</label>
                            <input type="text" class="form-control" id="e_name" name="name" placeholder="Teljes név">
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <label for="email">E-mail cím</label>
                            <input type="email" class="form-control" id="e_email" name="email" placeholder="email@cim.hu">
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <label for="telephone">Telefonszám</label>
                            <input type="tel" class="form-control" id="e_phone" name="phone" placeholder="Telefonszám">
                            <label for="Message">Üzenet</label>
                            <textarea class="form-control" rows="5" id="e_message" name="message" placeholder="Üzenet"></textarea>
                            <button onclick="sendMail();" type="button" class="form-control" id="cf-submit" name="submit">Üzenet elküldése</button>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <span id="emailSuccess" class="text-info hidden"></span>
                            <span id="emailError" class="text-danger hidden"></span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>


<!-- GOOGLE MAP -->
<section id="google-map">
    <!-- How to change your own map point
           1. Go to Google Maps
           2. Click on your location point
           3. Click "Share" and choose "Embed map" tab
           4. Copy only URL and paste it within the src="" field below
    -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2719.5746640641783!2d19.77927411591658!3d47.028953335694354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47416321221302a3%3A0x88fde7bd6c4b4844!2zT3Jvc3psw6FuIEd5w7NneXN6ZXJ0w6Fy!5e0!3m2!1shu!2shu!4v1597060752636!5m2!1shu!2shu" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</section>      
