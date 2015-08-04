function tile() {
    var windowWidth = jQuery(window).width();
    if (windowWidth > 767) {
        var maxHeight = 150;
        jQuery(".tile").css("height", "auto");
        jQuery('.tile').each(function() {
            var thisHeight = jQuery(this).height();
            if (thisHeight > maxHeight) {
                maxHeight = thisHeight;
            }
        });
        jQuery(".tile").css("height", maxHeight + "px");
    } else {
        jQuery(".tile").css("height", "auto");
    }
}