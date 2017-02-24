// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({html: true}); 
	
	$(".headlines .headline .item").css('visibility', 'visible');
	if ($(window).width() >= 800) {
		$('header#main_header .middle_header ul.primary-menu').css('display', 'block');
	}
	else {
		$('header#main_header .middle_header ul.primary-menu').css('display', 'none');
	}

	$(window).resize(function () {
		var win = $(this);

		$('.c-hamburger').removeClass('is-active');
		$('header#main_header .top_header ul.utility-menu').removeClass('inactive');
		$('header#main_header div#primary_navigation').removeClass('menu-on');
		$('header#main_header .middle_header ul.primary-menu').removeClass('menu-toggle-on');
		
		if (win.width() >= 800){
			$('header#main_header .middle_header ul.primary-menu').css('display', 'block');
		}else{
			$('header#main_header .middle_header ul.primary-menu').css('display', 'none');
		}
	});
	
  /*
   * back to top button
   */ 

  $(window).scroll(function(){
      var offset = 800,
      //footerHeight = $('footer').height() + 80,
      //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
      offset_opacity = 1000;
      //grab the "back to top" link
      $back_to_top = $('.back_to_top-button');
      ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('button_visible') : $back_to_top.removeClass('button_visible fade-out');
      if( $(this).scrollTop() > offset_opacity ) { 
        $back_to_top.addClass('fade-out');
      }
  });

  /*
   * Smooth Scroll
   */
  $('a.smooth-scroll[href^="#"]').on('click',function (e) {
      e.preventDefault();
      var target = this.hash;
      var $target = $(target);
      if(target == '#accordion') {
        // do nothing
      } else if(target.length == 0) {
        $('html,body').animate({
          scrollTop: 0
        }, 1200);
      } else {
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top - 150
        }, 1200, 'swing');
      }
  });
});

$(function () {
	updateHeadlineHeight();
	setTimeout(updateHeadlineHeight, 500);
	$(window).resize(updateHeadlineHeight);
	
	function updateHeadlineHeight() {
		$(".headlines .headline .item").css('height', 'auto');
		
		var maxHeight = 0;

		$(".headlines .headline .item").each(function(){
		   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
		});

		$(".headlines .headline .item").height(maxHeight);
	}
});
	
(function() {
	"use strict";

	var toggles = document.querySelectorAll(".c-hamburger");

	for (var i = toggles.length - 1; i >= 0; i--) {
		var toggle = toggles[i];
		toggleHandler(toggle);
	};

	function toggleHandler(toggle) {
		toggle.addEventListener( "click", function(e) {
			e.preventDefault();
			if (this.classList.contains("is-active") === true) {
				this.classList.remove("is-active");
				$('header#main_header .top_header ul.utility-menu').removeClass('inactive');
				$('header#main_header div#primary_navigation').removeClass('menu-on');
				$('header#main_header .middle_header ul.primary-menu').removeClass('menu-toggle-on');
				$('header#main_header .middle_header ul.primary-menu').slideUp('fast');
			} else{
				this.classList.add("is-active");
				$('header#main_header .top_header ul.utility-menu').addClass('inactive');
				$('header#main_header div#primary_navigation').addClass('menu-on');
				$('header#main_header .middle_header ul.primary-menu').addClass('menu-toggle-on');
				$('header#main_header .middle_header ul.primary-menu').slideDown('medium');
			}
			
		});
	}
})();

function init() {
	window.addEventListener('scroll', function(e){
		var distanceY = window.pageYOffset || document.documentElement.scrollTop,
			shrinkOn = 200,
			header = document.querySelector("header#main_header");
		if (distanceY > shrinkOn) {
			classie.add(header,"scrolled");
		} else {
			if (classie.has(header,"scrolled")) {
				classie.remove(header,"scrolled");
			}
		}
	});
}
window.onload = init();

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1);
		if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	}
	return "";
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays*24*60*60*1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}

$.fn.stars = function() {
    return $(this).each(function() {
        // Get the value
        var val = parseFloat($(this).html());
		val = Math.round(val * 4) / 4;
        // Make sure that the value is in 0 - 5 range, multiply to get width
        var size = Math.max(0, (Math.min(5, val))) * 13;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}

$(document).ready(function(){
	//$(document).snowfall('clear');
	//$(document).snowfall({image :"http://www.upvanguard.org/dev/images/rotate.php", minSize: 10, maxSize:32});
	//$(document).snowfall({shadow : true, round : true,  minSize: 5, maxSize:8}); // add shadows
});