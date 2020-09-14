
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
function search(elem, elem_type) {
    console.log(jQuery(".search-input").val());
}

jQuery(document).ready(function() {
    $(".search-input").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            search();
        }
    });
});