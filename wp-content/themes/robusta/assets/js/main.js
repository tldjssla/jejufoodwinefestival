!(function($){
	"use strict";
	jQuery(document).ready(function($) {
		// Same Height
		jQuery('.vc_row.same-height .row').each(function() {
			var MaxHeight = 0;
			jQuery(this).children().each(function() {
				var height = jQuery(this).height();
				if(MaxHeight < height) {
					MaxHeight = height;
				}
			});
			jQuery(this).children().each(function() {
				jQuery(this).css('min-height', MaxHeight);
			});
		});
		//Back top
		function ROBackTop() {
			$('#ro-backtop').on('click', function() {
				$('html,body').animate({
					scrollTop: 0
				}, 400);
				return false;
			});

			if ($(window).scrollTop() > 300) {
				$('#ro-backtop').addClass('ro-show');
			} else {
				$('#ro-backtop').removeClass('ro-show');
			}

			$(window).on('scroll', function() {

				if ($(window).scrollTop() > 300) {
					$('#ro-backtop').addClass('ro-show');
				} else {
					$('#ro-backtop').removeClass('ro-show');
				}
			});
		}
		ROBackTop();
		//Date picker
		function RODatePicker() {
			if ($('.ro-date-picker').length) {
				$('.ro-date-picker').datepicker();
			}
		}
		RODatePicker();
		//useful var
		var $window = $(window);
		var mainMenuHeight = $('#ro-main-menu').height();
		/* Make easing scroll when click a link in page */
		function ROEasingMoving() {
			var $root = $('html, body');
			$('.ro-menu-list.secondary_navigation > ul > li > a').on('click', function() {
				var href = $.attr(this, 'href');
				$root.animate({
					scrollTop: ($(href).offset().top - mainMenuHeight)
				}, 500, function() {
					window.location.hash = href;
				});
				return false;
			});
		}
		ROEasingMoving();
		/* Make video scale like background-size:cover */
		function ROVideoCover(VideoRatio) {
			$('.ro-video-bg-wrapper').each(function() {
				var $this = $(this);
				if ($this.height() * VideoRatio > $this.width())
					$(this).addClass('ro-video-h');
				else
					$(this).removeClass('ro-video-h');
				$(window).on('resize', function() {
					if ($this.height() * VideoRatio > $this.width())
						$this.addClass('ro-video-h');
					else
						$this.removeClass('ro-video-h');
				});
			});
		}
		ROVideoCover(16 / 9);
		//Video popup
		function ROheadervideo() {
			$("#ro-play-button").on("click", function(e){
				e.preventDefault();
					$.fancybox({
					'padding' : 0,
					'autoScale': false,
					'transitionIn': 'none',
					'transitionOut': 'none',
					'title': this.title,
					'width': 720,
					'height': 405,
					'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
					'type': 'swf',
					'swf': {
					'wmode': 'transparent',
					'allowfullscreen': 'true'
					}
				});
			});
		}
		ROheadervideo();
		/* Open the hide menu canvas */
		function ROOpenMenuSidebar() {
			$('.ro-menu-sidebar > a').on('click', function() {
				$('body').toggleClass('ro-menu-canvas-open');
			});
			$('.ro-menu-canvas-overlay').on('click', function() {
				$('body').toggleClass('ro-menu-canvas-open');
			});
		}
		ROOpenMenuSidebar();
		/* Open the hide menu */
		function ROOpenMenu() {
			$('#ro-hamburger').on('click', function() {
				$('.ro-menu-list').toggleClass('hidden-xs');
				$('.ro-menu-list').toggleClass('hidden-sm');
			});
		}
		ROOpenMenu();
		/* Header Stick */
		function ROHeaderStick() {
			var header_offset = $('.ro-header-fixed').offset();
			
			if ($window.scrollTop() > header_offset.top) {
				$('body').addClass('ro-stick-active');
			} else {
				$('body').removeClass('ro-stick-active');
			}

			$window.on('scroll', function() {
				if ($window.scrollTop() > 0) {
					$('body').addClass('ro-stick-active');
				} else {
					$('body').removeClass('ro-stick-active');
				}
			});
		}
		ROHeaderStick();
		$( window ).resize(function() { ROHeaderStick(); });
		
		/*fancybox for gallery*/
		function ROfancybox() {
			$('a.ro-zoom-image').fancybox();
		}
		ROfancybox();
	
		/* Active blog slider */
		function ROBlogSlider() {
			$('.ro-blog-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: false,
				directionNav: true,
				prevText: "",
				nextText: "",
				itemWidth: 384,
				itemMargin: 0,
				minItems: 1, 
				maxItems: 5,
				move: 1,
			});
		}
		ROBlogSlider();
		
		/* Active team slider */
		function ROTeamSlider() {
			$('.ro-team-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: false,
				directionNav: true,
				prevText: "",
				nextText: "",
			});
		}
		ROTeamSlider();
		
		/* Active latest news slider */
		function ROLatestNewsSlider() {
			$('.ro-latest-news-slider').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: false,
				directionNav: true,
				prevText: "",
				nextText: "",
			});
		}
		ROLatestNewsSlider();
		
		/* Active testimonial slider */
		function ROtesttimonialSlider() {
			$('.ro-testimonial').flexslider({
				animationSpeed: 700,
				animation: "slide",
				controlNav: true,
				directionNav: false,
			});
		}
		ROtesttimonialSlider();
		
		function ROcountdownClock() {
			$('.ro-countdown-clock').each(function() {
				var countdownTime = $(this).attr('data-countdown');
				$(this).countdown({
					until: countdownTime,
					format: 'ODHMS',
					padZeroes: true
				});
			});
		}
		ROcountdownClock();
		
		/* Disable scrolling zoom on maps */
		$('#map').addClass('scrolloff');
		$('.overlay_map').on("mouseup",function(){
			$('#map').addClass('scrolloff'); 
		});
		$('.overlay_map').on("mousedown",function(){
			$('#map').removeClass('scrolloff');
		});
		$("#map").mouseleave(function () { 
			$('#map').addClass('scrolloff');
		});
		/*Shop*/
		$('.woocommerce-info .ro-checkout-title > a').on('click', function(event) {
			$( event.target ).closest('.woocommerce-info').toggleClass('ro-active');
		});
		function ROOpenMiniCartSidebar() {
			$('.ro_widget_mini_cart > a.ro-icon').on('click', function() {
				$('.ro_widget_mini_cart .ro-cart-content').toggle();
			});
			$('.ro_widget_mini_cart .ro-cart-content > a.ro-close').on('click', function() {
				$(this).parent().toggle();
			});
		}
		ROOpenMiniCartSidebar();
	});
})(jQuery);