 jQuery(document).ready(function(){
    new WOW().init();
    jQuery('.burger-menu').click(function () {
        jQuery(this).toggleClass('active');
        jQuery('.header .menu').toggleClass('open');
        if (jQuery(this).hasClass("active")){
            jQuery('body').css('overflow', 'hidden');
        }
        else {
            jQuery('body').css('overflow', 'auto');
        }
    });
// filter
    jQuery(".operation-label").on("click", function() {
        jQuery(".operation-label").removeClass('active');
        jQuery(this).addClass('active');
    });

      jQuery(".select").on("click", function() {
        jQuery(this).toggleClass('open');
    });
    jQuery(".select .select-label").on("click", function(e) {
        e.stopPropagation();
        var $this = jQuery(this);        
        var selectedText = $this.text();
        $this.parent().find('.select-label').removeClass('selected');
        $this.addClass('selected');
        $this.parent().parent().find('.select-title').text(selectedText);
        $this.parent().parent().removeClass('open');        
    });
    jQuery("#region .select-label").on("click", function() {
      var $thisRegion = jQuery(this).attr('data-region');
      if ($thisRegion === '0') {
        jQuery('#mRegion .select-label').show();
      } else {
        jQuery('#mRegion .select-label').hide();
        jQuery('#mRegion .select-label[data-region="' + $thisRegion + '"]').show();
      }
   });
    jQuery(".filter-form .show-advanced-search").on("click", function(e) {
      e.preventDefault();
      jQuery(".filter-form .advanced-search").slideToggle();
      jQuery(this).toggleClass('open');
    });
    jQuery("#objectType .select-label").click(function()  {
      jQuery('.input-number').val("");
      var thisValue = jQuery(this).children().attr('value');
      jQuery('#advancedSearch .field-box').hide();      
      if (thisValue === '3'){
        jQuery('#mainSearch .field-box.total-area').hide();
        jQuery('#advancedSearch .field-box.land-area').show();
        jQuery('#advancedSearch .field-box.land-area').appendTo('#mainSearch');        
      } else {
        jQuery('#mainSearch .field-box.total-area').show();
        jQuery('#mainSearch .field-box.land-area').appendTo('#advancedSearch');
        if (thisValue === '1'){jQuery('#advancedSearch .field-box.flat').show();}
        if (thisValue === '2'){jQuery('#advancedSearch .field-box.house').show();}      
        if (thisValue === '4'){jQuery('#advancedSearch .field-box.commerce').show();}
      }      
    });

    var slider = new Swiper('.object-slider', {
        navigation: {
            nextEl: '.object-slider-next',
            prevEl: '.object-slider-prev',
        },
        autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 'auto',
        spaceBetween: 15,   
    });



    // jQuery(".scroll").on("click", function(e) {
    //     e.preventDefault();
    //     const id = jQuery(this).attr("href"),
    //     top = jQuery(id).offset().top - 150;
    //     jQuery("body,html").animate({ scrollTop: top }, 1500);
    // });

    // jQuery(window).scroll(function() {
    // if (jQuery(window).scrollTop() > 30) {
    //   jQuery(".header").addClass("sticky");
    // } else {
    //   jQuery(".header").removeClass("sticky");
    // }
    // });

    // jQuery(".management-list .content").on("click", function(e) {
    //   jQuery(this).toggleClass('open');
    // });

    


    // const toTopLink = jQuery(".to-top");
    // if (toTopLink.length) {
    //   const backToTop = function() {
    //     const scrollTrigger = 1000;
    //     let scrollTop = jQuery(window).scrollTop();
    //     if (scrollTop > scrollTrigger) {
    //       toTopLink.addClass("show-to-top");
    //     } else {
    //       toTopLink.removeClass("show-to-top");
    //     }
    //   };
    //   backToTop();
    //   jQuery(window).on("scroll", function() {
    //     backToTop();
    //   });
    //   toTopLink.on("click", function(e) {
    //     e.preventDefault;
    //     jQuery("html, body").animate({ scrollTop: 0 }, 1200);
    //   });
    // }

    var mainSlider = new Swiper('.main-slider .swiper-container', {
        navigation: {
            nextEl: '.main-slider-next',
            prevEl: '.main-slider-prev',
        },
        autoplay: {delay: 2500,},
        loop: true,   
    });

   


});
