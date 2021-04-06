$('#agreement').change( function() {
	if( $(this).prop('checked') ) {
		$('#btn_disabled').hide();
		$('#btn_enabled').show();
	}
	else {
		$('#btn_enabled').hide();
		$('#btn_disabled').show();
	}
});

$(document).on('keyup', '#zip', function() {
	AjaxZip3.zip2addr('zip', '', 'address', 'address');
});

