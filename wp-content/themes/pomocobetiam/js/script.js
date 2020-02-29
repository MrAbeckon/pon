/**
 * Global variables
 */
"use strict";

jQuery(function($){ 

var userAgent = navigator.userAgent.toLowerCase(),
  initialDate = new Date(),

  $document = $(document),
  $window = $(window),
  $html = $("html"),

  isDesktop = $html.hasClass("desktop"),
  isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1]) : userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false,
  isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
  isTouch = "ontouchstart" in window,

  plugins = {
    rdGoogleMaps: $(".rd-google-map"),
    reCaptchaValidation: $('.wpcf7-form'),
    navigationBar: $('.page-head'),
  };

/**
 * Initialize All Scripts
 */
$document.ready(function () {
  var isNoviBuilder = window.xMode;

  // The function actually applying the offset
  function offsetAnchor() {
    if (location.hash.length !== 0) {
      window.scrollTo(window.scrollX, window.scrollY - 126);
    }
  }

  // Captures click events of all <a> elements with href starting with #
  $(document).on('click', 'a[href^="#"]', function(event) {
    // Click events are captured before hashchanges. Timeout
    // causes offsetAnchor to be called after the page jump.
    window.setTimeout(function() {
      offsetAnchor();
    }, 0);
  });

  // Set the offset when entering page with hash present in the url
  window.setTimeout(offsetAnchor, 0);

  /**
   * Adjustments for Safari on Mac
   */
  (function($){
    if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Mac') != -1 && navigator.userAgent.indexOf('Chrome') == -1) {
      $('html').addClass('mac'); // provide a class for the safari-mac specific css to filter with
    }
  })(jQuery);

  /**
   * isScrolledIntoView
   * @description  check the element whas been scrolled into the view
   */
  function isScrolledIntoView(elem) {
    var $window = $(window);
    return elem.offset().top + elem.outerHeight() >= $window.scrollTop() && elem.offset().top <= $window.scrollTop() + $window.height();
  }

  /**
   * initOnView
   * @description  calls a function when element has been scrolled into the view
   */
  function lazyInit(element, func) {
    var $win = jQuery(window);
    $win.on('load scroll', function () {
      if ((!element.hasClass('lazy-loaded') && (isScrolledIntoView(element)))) {
        func.call();
        element.addClass('lazy-loaded');
      }
    });
  }
  /**
   * getSwiperHeight
   * @description  calculate the height of swiper slider basing on data attr
   */
  function getSwiperHeight(object, attr) {
    var val = object.attr("data-" + attr),
      dim;

    if (!val) {
      return undefined;
    }

    dim = val.match(/(px)|(%)|(vh)$/i);

    if (dim.length) {
      switch (dim[0]) {
        case "px":
          return parseFloat(val);
        case "vh":
          return $(window).height() * (parseFloat(val) / 100);
        case "%":
          return object.width() * (parseFloat(val) / 100);
      }
    } else {
      return undefined;
    }
  }

  /**
   * toggleSwiperInnerVideos
   * @description  toggle swiper videos on active slides
   */
  function toggleSwiperInnerVideos(swiper) {
    var prevSlide = $(swiper.slides[swiper.previousIndex]),
      nextSlide = $(swiper.slides[swiper.activeIndex]),
      videos;

    prevSlide.find("video").each(function () {
      this.pause();
    });

    videos = nextSlide.find("video");
    if (videos.length) {
      videos.get(0).play();
    }
  }

  /**
   * toggleSwiperCaptionAnimation
   * @description  toggle swiper animations on active slides
   */
  function toggleSwiperCaptionAnimation(swiper) {
    var prevSlide = $(swiper.container),
      nextSlide = $(swiper.slides[swiper.activeIndex]);

    prevSlide
      .find("[data-caption-animate]")
      .each(function () {
        var $this = $(this);
        $this
          .removeClass("animated")
          .removeClass($this.attr("data-caption-animate"))
          .addClass("not-animated");
      });


    nextSlide
      .find("[data-caption-animate]")
      .each(function () {
        var $this = $(this),
          delay = $this.attr("data-caption-delay");

          setTimeout(function () {
            $this
              .removeClass("not-animated")
              .addClass($this.attr("data-caption-animate"))
              .addClass("animated");
          }, delay ? parseInt(delay) : 0);
        
      });
  }
  if (plugins.navigationBar.length) {

    var innerNavWrap = $('.page-head-nav-list');   
    var navItems = innerNavWrap.children('li');

    navItems.each(function(index) {
      if(window.location.pathname == $(this).children('a')[0].pathname) {

        $(this).addClass('active');
      }
    });
  }
  // cookie consent
  if(false) {
    window.cookieconsent.initialise({
      container: document.getElementById("cookieconsent"),
      palette:{
        popup: { background: "#1aa3ff" },
        button: { background: "#e0e0e0" },
      },
      revokable: false,
      onStatusChange: function(status) {
        console.log(this.hasConsented() ?
        'enable cookies' : 'disable cookies');
      },
      "position": "bottom",
      "theme": "classic",
      "domain": "http://kurzysap.cz/",
      "secure": false,
      "content": {
        "header": 'Na stránce jsou použity cookies!',
        "message": 'Informace o souborech cookie. Tento web využívá soubory cookie, aby vám mohl nabídnout některé služby a zvýšil váš uživatelský komfort. Využíváním našeho webu vyjadřujete souhlas s používáním souborů cookie v souladu s popisem v našich Zásadách použití souborů cookie.',
        "dismiss": 'Zavřít',
        "allow": 'Povolit',
        "deny": 'Zamítnout',
        "link": 'Více',
        "href": 'prohlaseni-k-souborum-cookies',
        "close": '&#ec6344;',
        "policy": 'Cookie Policy',
        "target": '_blank',
        }
    });
    $('.cc-link').prependTo('.cc-compliance');
    $('.cc-dismiss').click(()=>{
      $('.cc-window').slideUp();
    })
  }

  /**
   * IE Polyfills
   * @description  Adds some loosing functionality to IE browsers
   */
  if (isIE) {
    if (isIE < 10) {
      $html.addClass("lt-ie-10");
    }

    if (isIE < 11) {
      if (plugins.pointerEvents) {
        $.getScript(plugins.pointerEvents)
          .done(function () {
            $html.addClass("ie-10");
            PointerEventsPolyfill.initialize({});
          });
      }
    }

    if (isIE === 11) {
      $("html").addClass("ie-11");
    }

    if (isIE === 12) {
      $("html").addClass("ie-edge");
    }
  }

});
  
  if (plugins.reCaptchaValidation.length) {

    var form = $('.wpcf7-form');
    
    form.submit(function(e) {
      var response = grecaptcha.getResponse();
      var required = form.find('input[aria-required="true"]');
      var spanRequired = $('<span />').addClass('wpcf7-not-valid-tip').html('The field is required.');

      spanRequired.attr('role', 'alert');
      var requiredFilled = true;

      if(response.length == 0) 
      { 
        //reCaptcha not verified
        alert("Please verify you are human!"); 
        e.preventDefault();
        return false;
      } else {
        if ($('.mail-success').length == 0) {
          $('body').append("<div class='mail-success'></div>");
          let success = $('.mail-success');

          success.append("<div class='mail-success-inner'></div>");
          let success_inner = $('.mail-success-inner');

          success_inner.text('Váš požadavek byl úspěšně odeslán.');
          success.slideDown();

          setTimeout(()=> {
            success.slideUp();
          }, 3000);
        }
      }

    });

  }
/**
   * RD Google Maps
   * @description Enables RD Google Maps plugin
   */
  if (plugins.rdGoogleMaps.length) {
    var i;
    $.getScript("//maps.google.com/maps/api/js?key=AIzaSyD8wff3dxcoXHYSJHnZNGMiXTctffRYwzU&sensor=false&libraries=geometry,places&v=3.7", function() {
      var head = document.getElementsByTagName('head')[0],
        insertBefore = head.insertBefore;

      head.insertBefore = function(newElement, referenceElement) {
        if (newElement.href && newElement.href.indexOf('//fonts.googleapis.com/css?family=Roboto') != -1 || newElement.innerHTML.indexOf('gm-style') != -1) {
          return;
        }
        insertBefore.call(head, newElement, referenceElement);
      };

      function initGoogleMap(){
        $('.map_locations').removeClass('collapse');
        var $this = $(this),
          styles = $this.attr("data-styles");

        $this.googleMap({
          styles: styles ? JSON.parse(styles) : [],
          onInit: function(map) {
            var inputAddress = $('#rd-google-map-address');

            if (inputAddress.length) {
              var input = inputAddress;
              var geocoder = new google.maps.Geocoder();
              var marker = new google.maps.Marker({
                map: map,
                icon: "../wp-content/themes/kctdata_courses/images/gmap_marker.png",
              });
              var autocomplete = new google.maps.places.Autocomplete(inputAddress[0]);
              autocomplete.bindTo('bounds', map);
              inputAddress.attr('placeholder', '');
              inputAddress.on('change', function() {
                $("#rd-google-map-address-submit").trigger('click');
              });
              inputAddress.on('keydown', function(e) {
                if (e.keyCode == 13) {
                  $("#rd-google-map-address-submit").trigger('click');
                }
              });


              $("#rd-google-map-address-submit").on('click', function(e) {
                e.preventDefault();
                var address = input.val();
                geocoder.geocode({
                  'address': address
                }, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();

                    map.setCenter(new google.maps.LatLng(
                      parseFloat(latitude),
                      parseFloat(longitude)
                    ));
                    marker.setPosition(new google.maps.LatLng(
                      parseFloat(latitude),
                      parseFloat(longitude)
                    ))
                  }
                });
              });
            }
          }
        });
      }

      for (i = 0; i < plugins.rdGoogleMaps.length; i++) {
          initGoogleMap.bind(plugins.rdGoogleMaps[i])();
      }
    });
  }
});