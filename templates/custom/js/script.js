 jQuery(document).ready(function(){
    new WOW().init();
    jQuery('.burger-menu').click(function () {
        jQuery(this).toggleClass('active');
        jQuery('.menu-mobile').toggleClass('open');
        jQuery('.body-wrapper').toggleClass('hidden');
        if (jQuery(this).hasClass("active")){
            jQuery('body').css('overflow', 'hidden');
        }
        else {
            jQuery('body').css('overflow', 'auto');
        }
    });
    jQuery(".scroll").on("click", function(e) {
        e.preventDefault();
        const id = jQuery(this).attr("href"),
        top = jQuery(id).offset().top - 250;
        jQuery("body,html").animate({ scrollTop: top }, 1500);
    });

    jQuery(window).scroll(function() {
    if (jQuery(window).scrollTop() > 300) {
      jQuery(".header").addClass("sticky");
    } else {
      jQuery(".header").removeClass("sticky");
    }
    });
    jQuery('.menu-mobile .parent > a, .menu-mobile .parent > span').click(function (e) {
        e.preventDefault();
        jQuery(this).toggleClass('open');
        jQuery(this).next('.nav-child').slideToggle();

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
    var $selectedRegion = jQuery("#region .select-input:checked").val();
    if(typeof($selectedRegion) != "undefined" && $selectedRegion !== null && $selectedRegion !== '0') {
    	jQuery('#mRegion .select-label').hide();
        jQuery('#mRegion .select-label[data-region="' + $selectedRegion + '"]').show();
    } 
    
    jQuery("#region .select-label").on("click", function() {
      var $thisRegion = jQuery(this).children('.select-input').val();
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

    var advancedSearchFields = function(val){
    	jQuery('#advancedSearch .field-box').hide();      
      if (val === '3'){
        jQuery('#mainSearch .field-box.total-area').hide();
        jQuery('#advancedSearch .field-box.land-area').show();
        jQuery('#advancedSearch .field-box.land-area').appendTo('#mainSearch');        
      } else {
        jQuery('#mainSearch .field-box.total-area').show();
        jQuery('#mainSearch .field-box.land-area').appendTo('#advancedSearch > .flex');
        if (val === '0'){jQuery('#advancedSearch .field-box').show();}
        if (val === '1'){jQuery('#advancedSearch .field-box.flat').show();}
        if (val === '2'){jQuery('#advancedSearch .field-box.house').show();}      
        if (val === '4'){jQuery('#advancedSearch .field-box.commerce').show();}
    }
}
	var $selectedObjectType = jQuery("#objectType .select-input:checked").val();
	if(typeof($selectedObjectType) != "undefined" && $selectedObjectType !== null && $selectedObjectType !== '0') {
		advancedSearchFields($selectedObjectType); 
	}

    jQuery("#objectType .select-label").click(function()  {
      jQuery('.input-number').val("");
      var $thisValue = jQuery(this).children('.select-input').val();
      advancedSearchFields($thisValue);    
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

    var nearbyObjectsSlider = new Swiper('.nearby-objects-slider', {
        // autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 1,
      spaceBetween: 12,
      pagination: {
        el: '.nearby-objects-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        },
        1450: {
          slidesPerView: 4,
        },
      }
    });
    var similarObjectsSlider = new Swiper('.similar-objects-slider', {
        // autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 1,
      spaceBetween: 12,
      pagination: {
        el: '.similar-objects-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        },
        1450: {
          slidesPerView: 4,
        },
      }
    });
    var hotObjectsSlider = new Swiper('.hot-objects-slider', {
        // autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 1,
      spaceBetween: 12,
      pagination: {
        el: '.hot-objects-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        },
        1450: {
          slidesPerView: 4,
        },
      }
    });
    var recommendObjectsSlider = new Swiper('.recommend-objects-slider', {
        // autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 1,
      spaceBetween: 12,
      pagination: {
        el: '.recommend-objects-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
        },
        1450: {
          slidesPerView: 4,
        },
      }
    });
    var weekOfferSlider = new Swiper('.week-offer-slider', {
        // autoplay: {delay: 3000,},
        loop: true,
        slidesPerView: 1,
        spaceBetween: 12,
         navigation: {
            nextEl: '.week-slider-next',
            prevEl: '.week-slider-prev',
        },      
    });

        jQuery(".show-map").click(function(e)  {
        e.preventDefault();
        jQuery(this).parent().parent().find('.map-box').toggleClass('open');
    });

    // counter on main page
    jQuery(function() {
      const counter = jQuery(".counter-section");
      if (jQuery("div").is(counter)) {
        jQuery(window).scroll(startCounter);
        function startCounter() {
          let hT = jQuery(counter).offset().top,
            hH = jQuery(counter).outerHeight(),
            wH = jQuery(window).height();
          if (jQuery(window).scrollTop() > hT + hH - wH) {
            jQuery(window).off("scroll", startCounter);
            jQuery(".counter_number").each(function() {
              var $this = jQuery(this);
              jQuery({ Counter: 0 }).animate(
                { Counter: $this.text() },
                {
                  duration: 3000,
                  easing: "swing",
                  step: function() {
                    $this.text(Math.ceil(this.Counter));
                  }
                }
              );
            });
          }
        }
       }
    });






    


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


   


});
