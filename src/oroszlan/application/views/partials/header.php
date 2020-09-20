<!-- HEADER -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-sm-6 hidden-xs header-top-left">
                <div class="welcome-message" style="display: inline-block; font-size: 12px;">Üdvözöljük a Nagykőrösi Oroszlán gyógyszertár weboldalán</div>
                <i style="margin-left: 5px;" onclick="searchClick(this);" class="search-btn fa fa-search fa-2x pull-right" aria-hidden="true"></i>
                <input onclick="searchClick(this, 'input');" type="text" class="form-control pull-right search-input" placeholder="Keresés" />
                <input onclick="search(this);" class="search-submit hidden" type="button" value="Keresés"/>
            </div>
            <div class="col-md-4 col-sm-5 visible-xs">
                <center>
                    <a href="<?php echo BASE_URL; ?>">
                        <img class="oroszlan_logo_xs" src="<?php echo VIEWS_URL; ?>images/oroszlan_logo.jpg" />
                    </a>
                    <p>
                        Üdvözöljük a Nagykőrösi Oroszlán gyógyszertár weboldalán
                    </p>
                </center>
            </div>
            <div class="col-md-12 visible-xs text-center">
                <span>
                    <i onclick="searchClick(this);" class="search-btn fa fa-search" aria-hidden="true"></i>
                    <input style="display: inline-block; margin-left: 0px;" onclick="searchClick(this, 'input');" type="text" class="form-control search-input" placeholder="Keresés" />
                    <input style="display: inline-block;" onclick="search(this);" class="search-submit hidden" type="button" value="Keresés"/>
                </span>
            </div>
            <div class="col-md-7 col-sm-6 text-align-right header-top-right hidden-xs">
                <span class="phone-icon"><i class="fa fa-phone"></i> (53) 350 182</span>
                <span class="date-icon hidden-xs"><i class="fa fa-calendar-plus-o"></i> Hétfő - Péntek: 7:30 - 18:30, Szombat: 8:00 - 12:00, Vasárnap: 8:00 - 10:00</span>
                <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="#">orogytar@gmail.com</a></span>
            </div>
        </div>
    </div>
</header>