jQuery( function($) {
	if( $('#place7').prop('checked') || $('#place8').prop('checked') ) {
		$('#seminar_ok').show();
		$('#seminar_kh').hide();
		$('#time_ok').show();
		$('#time_kh').hide();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else if( $('#place9').prop('checked') || $('#place10').prop('checked') ) {
		$('#seminar_ok').hide();
		$('#seminar_kh').show();
		$('#time_ok').hide();
		$('#time_kh').show();
		$('#input_area').show();
		$('#confirm_area').show();
	}
	else {
		$('#seminar_ok').hide();
		$('#seminar_kh').hide();
		$('#time_ok').hide();
		$('#time_kh').hide();
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
	if( $(this).val() == '7' || $(this).val() == '8' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#seminar_kh').slideUp();
		$('#seminar_ok').slideDown();
		$('#time_kh').slideUp();
		$('#time_ok').slideDown();
	}
	else if( $(this).val() == '9' || $(this).val() == '10' ) {
		$('#input_area').show();
		$('#confirm_area').show();
		$('#seminar_ok').slideUp();
		$('#seminar_kh').slideDown();
		$('#time_ok').slideUp();
		$('#time_kh').slideDown();
	}
	else {
		$('#input_area').hide();
		$('#confirm_area').hide();
		$('#seminar_ok').hide();
		$('#seminar_kh').hide();
		$('#time_ok').hide();
		$('#time_kh').hide();
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

