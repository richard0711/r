<!-- CONTENT DETAIL -->
<section id="news-detail" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="col-md-8 col-sm-7">
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

                <?php if (isset($content["gallery"]) && isset($content["gallery"]["gallery_items"])) { ?>
                    <h3>Képek</h3>
                    <div id="lightGallery" class="row">
                        <?php if (isset($content["gallery"]["gallery_items"]) && $content["gallery"]["gallery_items"]["count"] > 0) { ?>
                            <?php foreach ($content["gallery"]["gallery_items"]["data"] as $gitem) { ?>
                                <div class="gallery-image light-gallery-item col-lg-4 col-xs-12 col-sm-6 col-md-3"
                                     data-imagecid="<?php echo $gitem['idgallery_item']; ?>" 
                                     data-src="<?php echo str_replace("public.php/", "", RCMS_URL) . $gitem["image_path"]; ?>" 
                                     data-sub-html="<?php echo $gitem["name"] . "<br/>" . $gitem["text"]; ?>">
                                    <div style="background-image: url('<?php echo str_replace("public.php/", "", RCMS_URL) . $gitem["image_path"]; ?>')" 
                                         class="img-responsive gallery-item-image" 
                                         alt="<?php echo $gitem["name"]; ?>"></div>
                                    <p class="gallery-item-text">
                                        <i class="fa fa-picture-o" aria-hidden="true"></i> <?php echo " " . $gitem["name"]; ?>
                                        <br/>
                                        <?php if ($gitem["text"] != '') { ?>
                                            <?php echo " " . $gitem["text"]; ?></span>
                                        <?php } else { ?>
                                            <i>nincs leírás</i>
                                        <?php } ?>
                                    </p>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($content["contactform"] == 1) { ?>
                    <section id="appointment" data-stellar-background-ratio="3">
                        <div class="">
                            <!-- CONTACT FORM HERE -->
                            <form id="appointment-form" role="form" method="post">
                                <div class="wow fadeInUp" data-wow-delay="0.8s">
                                    <div class="col-md-12 col-sm-12">
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
                    </section>
                <?php } ?>

                <div class="news-social-share">
                    <h4>Ossza meg a cikket</h4>
                    <div class="fb-like" data-href="<?php echo FULL_BASE_URL . 'p/content/' . $content["idcontent"]; ?>"  data-width="300" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-5">
            <div class="news-sidebar">
                <?php if (isset($other_contents) && $other_contents["count"] > 1) { ?>
                    <div class="recent-post">
                        <h4>További cikkek</h4>
                        <?php
                        $max_count = 3;
                        $ocontent_counter = 0;
                        foreach ($other_contents["data"] as $ocontent) {
                            if ($ocontent["idcontent"] == $content["idcontent"]) {
                                continue;
                            } if ($max_count == $ocontent_counter) {
                                break;
                            } else {
                                $ocontent_counter++;
                            }
                            ?> 
                            <div class="media">
                                <div class="media-object pull-left">
                                    <a href="<?php echo FULL_BASE_URL . 'p/content/' . $ocontent["idcontent"]; ?>">
                                        <?php if (isset($ocontent["content_items"]) && $ocontent["content_items"]["count"] > 0) { ?>
                                            <div style="background: url('<?php echo str_replace("public.php/", "", RCMS_URL) . $ocontent["content_items"]["data"][0]["image_path"]; ?>');" class="circle-div" alt=""></div>
                                        <?php } else { ?>
                                            <div style="background: url('<?php echo VIEWS_URL; ?>images/ujlogo.jpg');" class="circle-div" alt=""></div>
                                        <?php } ?>
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="<?php echo FULL_BASE_URL . 'p/content/' . $ocontent["idcontent"]; ?>"><?php echo $ocontent["title"]; ?></a>
                                        <br/>
                                        <small class="text-muted"><?php echo formatted_date_time($ocontent["published"], false, '', 'hun'); ?></small>
                                    </h4>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</section>