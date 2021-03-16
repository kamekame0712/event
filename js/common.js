$(window).trigger('scroll');

$(window).scroll( function() {
	if( $(this).scrollTop() > 200 ) {
		$('#go_to_top').fadeIn();
	}
	else {
		$('#go_to_top').fadeOut();
	}
});

$(document).on('click', '#go_to_top', function() {
	var top = $(window).scrollTop();

	$('body,html').animate({
		scrollTop: 0
	}, top / 2);
});

function move_to(to)
{
	var top = $('#' + to).offset().top;
	$('body,html').animate({
		scrollTop: top
	}, top / 2);
}