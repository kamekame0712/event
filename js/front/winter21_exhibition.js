jQuery( function($) {
	if( $('#place1').prop('checked') ) {
		$('#select_time_1').show();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place2').prop('checked') ) {
		$('#select_time_1').hide();
		$('#select_time_2').show();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place3').prop('checked') ) {
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_3').show();
		$('#select_time_4').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place4').prop('checked') ) {
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
		$('#select_time_4').show();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else {
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
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
	if( $(this).val() == '1' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_1').show();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
	}
	else if( $(this).val() == '2' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_1').hide();
		$('#select_time_2').show();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
	}
	else if( $(this).val() == '3' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_3').show();
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_4').hide();
	}
	else if( $(this).val() == '4' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#select_time_4').show();
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
	}
	else {
		$('#input_area').hide();
		$('#confirm_area').hide();
		$('#select_time_1').hide();
		$('#select_time_2').hide();
		$('#select_time_3').hide();
		$('#select_time_4').hide();
	}

	$('[name="time"]:checked').prop('checked', false);
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

