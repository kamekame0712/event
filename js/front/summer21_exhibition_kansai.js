jQuery( function($) {
	if( $('#place7').prop('checked') ) {
		$('#select_time_7').show();
		$('#select_time_8').hide();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place8').prop('checked') ) {
		$('#select_time_7').hide();
		$('#select_time_8').show();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place9').prop('checked') ) {
		$('#select_time_7').hide();
		$('#select_time_8').hide();
		$('#select_time_9').show();
		$('#select_time_10').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place10').prop('checked') ) {
		$('#select_time_7').hide();
		$('#select_time_8').hide();
		$('#select_time_9').hide();
		$('#select_time_10').show();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else {
		$('#select_time_7').hide();
		$('#select_time_8').hide();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
		$('#input_area').hide();
		$('#confirm_area').hide();
	}

	if( $('#agreement').prop('checked') ) {
		$('#btn_disabled').hide();
		$('#btn_enabled').show();
	}
	else {
		$('#btn_enabled').hide();
		$('#btn_disabled').show();
	}
});

$('[name="place"]').change( function() {
	if( $(this).val() == '7' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_7').show();
		$('#select_time_8').hide();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
	}
	else if( $(this).val() == '8' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_8').show();
		$('#select_time_7').hide();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
	}
	else if( $(this).val() == '9' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_9').show();
		$('#select_time_7').hide();
		$('#select_time_8').hide();
		$('#select_time_10').hide();
	}
	else if( $(this).val() == '10' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_10').show();
		$('#select_time_9').hide();
		$('#select_time_7').hide();
		$('#select_time_8').hide();
	}
	else {
		$('#input_area').hide();
		$('#confirm_area').hide();
		$('#select_time_7').hide();
		$('#select_time_8').hide();
		$('#select_time_9').hide();
		$('#select_time_10').hide();
	}
});

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

