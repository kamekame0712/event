jQuery( function($) {
	if( $('#agreement').prop('checked') && $('#newsletter').prop('checked') ) {
		$('#btn_disabled').hide();
		$('#btn_enabled').show();
	}
	else {
		$('#btn_enabled').hide();
		$('#btn_disabled').show();
	}
});

$(document).on('change', '#agreement, #newsletter', function() {
	if( $('#agreement').prop('checked') && $('#newsletter').prop('checked') ) {
		$('#btn_disabled').hide();
		$('#btn_enabled').show();
	}
	else {
		$('#btn_enabled').hide();
		$('#btn_disabled').show();
	}

	if( $('#newsletter').prop('checked') ) {
		$('#newsletter_required').slideUp();
	}
	else {
		$('#newsletter_required').slideDown();
	}
});
