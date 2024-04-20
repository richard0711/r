
var fullsizesearch = false;
function searchClick(elem, elem_type) {
    if (elem_type && elem_type == 'input') {
        fullsizesearch = true;
        jQuery(".search-submit").removeClass('hidden');
        jQuery(".search-input").addClass("full-size-search");
        jQuery(".welcome-message").hide();
        return;
    }
    if (fullsizesearch) {
        fullsizesearch = false;
        jQuery(".search-submit").addClass('hidden');
        jQuery(".search-input").removeClass("full-size-search");
        jQuery(".welcome-message").show();
    } else {
        fullsizesearch = true;
        jQuery(".search-submit").removeClass('hidden');
        jQuery(".search-input").addClass("full-size-search");
        jQuery(".welcome-message").hide();
        jQuery(".search-input").focus();
    }
}
function search() {
    var search_string = '';
    jQuery(".search-input").each(function (item, val) {
        if (jQuery(val).val() != '') {
            search_string = jQuery(val).val();
        }
    });
    
    if (search_string == '') {
        return;
    } else {
        window.location = FULL_BASE_URL+'p/search/1?s='+search_string;
    }
}

function setUpLightGallery() {
    jQuery("#lightGallery").lightGallery();
}

function showMoreMenuItem() {
    jQuery("#more-menu-items").removeClass("hidden");
}

function openLink(link) {
    window.location = link;
}

function sendMail() {
    var data = {
        e_email : jQuery("#e_email").val(),
        e_name : jQuery("#e_name").val(),
        e_phone : jQuery("#e_phone").val(),
        e_message : jQuery("#e_message").val()
    };
    jQuery.ajax({
        url: FULL_BASE_URL.replace("index.php/","sendmail.php"),
        type: "POST",
        async: false,
        dataType: 'json',
        data: JSON.stringify(data),
        contentType: 'application/json'
        //headers: ko.toJS(headers)
    }).done(function (response) {
        if (response.success) {
            jQuery("#emailError").addClass("hidden");
            jQuery("#emailSuccess").removeClass("hidden");
            jQuery("#emailSuccess").html(response.success);
        } else {
            jQuery("#emailSuccess").addClass("hidden");
            jQuery("#emailError").removeClass("hidden");
            jQuery("#emailError").html(response.error);
            
        }
    }).fail(function (response) {
        console.log('error log : ', response);
    });
}

function setsubmenu() {
    if (jQuery(window).width() < 1535 && jQuery(window).width() > 767) {
        jQuery(".submenu").each(function(num, item){
            jQuery(item).addClass("revertul");
        });
    } else {
        jQuery(".submenu").each(function(num, item){
            jQuery(item).removeClass("revertul");
        });
    }
    //végig iterálunk a dropdown menükön és beállítjuk a left propertyt
    jQuery(".dropdown-menu").each(function(num, item) {
        if (num > 4) {
            if (!(jQuery(item).hasClass("submenu"))) {
                jQuery(item).parent("li").width();
                jQuery(item).css("left", (-1 * (190 - jQuery(item).parent("li").width())) + "px");
            }
        }
    });
}

jQuery(document).ready(function() {
//    jQuery(".palyazat2020").on('click', navigateToPalyazatContent);
    jQuery(window).resize(function(){
        if (jQuery(window).width() < 767) {
            jQuery(".collapse").removeClass("navbar-collapse");
        } else {
            jQuery(".collapse").addClass("navbar-collapse");
        }
        setsubmenu();
    });
    if (jQuery(window).width() < 767) {
        jQuery(".collapse").removeClass("navbar-collapse");
    } else {
        jQuery(".collapse").addClass("navbar-collapse");
    }
    jQuery(".search-input").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            search();
        }
    });
    setUpLightGallery();
    //////////////////////// Prevent closing from click inside dropdown
    jQuery(document).on('click', '.dropdown-menu', function (e) {
        e.stopPropagation();
    });

    // make it as accordion for smaller screens
    if (jQuery(window).width() < 992) {
        jQuery('.dropdown-menu a').click(function (e) {
            e.preventDefault();
            if ($(this).next('.submenu').length) {
                $(this).next('.submenu').toggle();
            }
            jQuery('.dropdown').on('hide.bs.dropdown', function (e) {
                jQuery(this).find('.submenu').hide();
            });
            e.stopPropagation();
            if ($(this).attr("href") != "javascript:void(0);" && 
                $(this).attr("href") != '#' && 
                $(this).attr("href") != 'javascript:void(null);' && 
                ($(this).attr("href").toString().indexOf("http://") >= 0 || 
                $(this).attr("href").toString().indexOf("https://") >= 0)) {
                window.location = $(this).attr("href");
            }
        });
    }
    setsubmenu();
    jQuery("oembed").each(function(num, item){
        var oembed = jQuery(item);
        var url = oembed.attr("url").toString();
        if (url.indexOf("youtube.com") > 0) {
            //akkor a .com/watch-ot probáljuk meg replacelni
            url = url.replace(".com/watch", ".com/embed");
        } else if (url.indexOf("youtu.be/")) {
            url = url.replace("youtu.be/", "youtube.com/embed/");
        }
        var iframe = jQuery('<iframe width="420px" height="345px" src="'+url+'" frameborder="0" allowfullscreen></iframe>');
        var figure = jQuery(item).parent("figure");
        jQuery(item).remove();
        figure.append(iframe);
    });
    
});

function navigateToPalyazatContent(e) {
    window.location = $(this).attr("data-href").toString();
}