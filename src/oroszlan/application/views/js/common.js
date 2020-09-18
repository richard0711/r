
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

jQuery(document).ready(function() {
    jQuery(".search-input").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            search();
        }
    });
    setUpLightGallery();
});