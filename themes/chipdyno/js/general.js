jQuery(document).ready(function(){
   if (jQuery('.innerPageView').length>0) {
        jQuery.fn.equalizeHeights = function(){
            return this.height( Math.max.apply(this, jQuery(this).map(function(i,e){ return jQuery(e).height() }).get() ) )
        }
       jQuery('.innerPageView').equalizeHeights();
   }
   if (jQuery('.vocabulary-product-category .field--type-image').length>0){
       jQuery('.field--name-description').addClass('list_category_box1');
   }
    if (jQuery('.layout-sidebar-first').length>0) {
        var height = jQuery('.layout_content_right').height();
        var sidebarHeight = jQuery('.layout-sidebar-first').height();
        if (parseInt(sidebarHeight) < parseInt(height)) {
            jQuery('.layout-sidebar-first').css('min-height',parseInt(height)+30+'px');
        }
    }
    if (jQuery('.recent-content-slider').length>0) {
        jQuery('.recent-content-slider').bxSlider({
            slideWidth: 230,
            minSlides: 2,
            maxSlides: 5,
            startSlide: 2,
            slideMargin: 10
        });
    }
});

