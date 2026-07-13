$('.selectpicker').selectpicker();
		
$('.datepicker').datepicker({
	language: 'hu',
	weekStart: 1,
	format: 'yyyy.mm.dd.',
	startDate: '0d',
	autoclose: true,
	/*<input pattern="\d*" readonly -> mobile number */
});

$('#myTab a').click(function (e) {
	e.preventDefault()
	$(this).tab('show')
});

$(window).load(function(){
	$('#basicModal').modal('hide');
});


(function($) {
	fakewaffle.responsiveTabs(['xs']);
})(jQuery);

// collapse close opened item
$(document).on('click','.navbar-collapse.in',function(e) {
	if( $(e.target).is('a') && $(e.target).attr('class') != 'dropdown-toggle' ) {
		$(this).collapse('hide');
	}
});

$(function () {
	$('.panel-group').on('shown.bs.collapse', function (e) {
    	var offset = $('.panel.panel-default > .panel-collapse.in').offset();
	    if(offset) {
	        $('html,body').animate({
	            scrollTop: $('.panel-collapse.in').siblings('.panel-heading').offset().top
	        }, 500); 
	    }
	});
});

$(function(){
	$(".uni-select select").uniform();
});


$(document).ready(function () {
  $('.tooltip-right').tooltip({
    placement: 'right',
    viewport: {selector: 'body', padding: 2}
  })
  $('.tooltip-bottom').tooltip({
    placement: 'bottom',
    viewport: {selector: 'body', padding: 2}
  })
  $('.tooltip-viewport-right').tooltip({
    placement: 'right',
    viewport: {selector: '.container-viewport', padding: 2}
  })
  $('.tooltip-viewport-bottom').tooltip({
    placement: 'bottom',
    viewport: {selector: '.container-viewport', padding: 2}
  })
});



$('.single-item').slick({
  dots:true,
  autoplay: true,
  prevArrow: '<i class="arrow arrow-left"></i>',
  nextArrow: '<i class="arrow arrow-right"></i>',
});

$('.member-item').slick({
  dots:false,
  autoplay: true,
  adaptiveHeight: true,
  prevArrow: '<i class="arrow arrow-left"></i>',
  nextArrow: '<i class="arrow arrow-right"></i>',
});



$('.parallax-window').parallax();

$(document).ready( function() {

  $('.brands-cont').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    masonry: {
      columnWidth: '.grid-sizer'
    }
  });

});

$(document).ready( function() {

  $('.brands-list').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    masonry: {
      columnWidth: '.grid-sizer'
    }
  });

});


$('.autoplay').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1000,
  variableWidth: true,
  prevArrow: '<i class="arrow arrow-left"></i>',
  nextArrow: '<i class="arrow arrow-right"></i>',
  responsive: [
	{
	  breakpoint: 767,
	  settings: {
		centerMode:false,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		variableWidth: false,
        autoplaySpeed: 1000,
	  }
	}
   ]
});




$('.navbar-nav').lavalamp({
	easing: 'easeOutBack',
	autoSize:true,
	autoUpdate:true,
	updateTime:0,
	setOnClick:true,
});




$(document).ready(function(){
	$("body").scrollspy({
		target: "#myNavbar",
		offset: 150
	})
});



$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
}); 





