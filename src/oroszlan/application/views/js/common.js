
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

jQuery(document).ready(function() {
    jQuery(".search-input").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            search();
        }
    });
    setUpLightGallery();
});

