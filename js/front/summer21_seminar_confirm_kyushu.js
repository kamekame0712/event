function do_submit(flg)
{
	if( flg == '1' ) {
		$('#frm_seminar_confirm').prop('action', SITE_URL + 'summer21/apply_seminar/kyushu').submit();
	}
	else {
		$('#frm_seminar_confirm').prop('action', SITE_URL + 'summer21/complete_seminar_kyushu').submit();
	}
}
