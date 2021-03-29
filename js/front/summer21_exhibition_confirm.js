function do_submit(flg, office)
{
	if( flg == '1' ) {
		$('#frm_exhibition_confirm').prop('action', SITE_URL + 'summer21/apply_exhibition/' + office).submit();
	}
	else {
		$('#frm_exhibition_confirm').prop('action', SITE_URL + 'summer21/complete_exhibition').submit();
	}
}
