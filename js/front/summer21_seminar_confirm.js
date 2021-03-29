function do_submit(flg, office)
{
	if( flg == '1' ) {
		$('#frm_seminar_confirm').prop('action', SITE_URL + 'summer21/apply_seminar/' + office).submit();
	}
	else {
		$('#frm_seminar_confirm').prop('action', SITE_URL + 'summer21/complete_seminar').submit();
	}
}
