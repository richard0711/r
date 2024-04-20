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
                                <div data-wow-delay="0.8s">
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
            </div>
        </div>

    </div>
</section>