function do_submit(flg)
{
	if( flg == '1' ) {
		$('#frm_confirm').prop('action', SITE_URL + 'winter21/apply').submit();
	}
	else {
		$('#frm_confirm').prop('action', SITE_URL + 'winter21/complete').submit();
	}
}
