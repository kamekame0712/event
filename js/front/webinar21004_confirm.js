function do_submit(flg)
{
	if( flg == '1' ) {
		$('#frm_webinar').prop('action', SITE_URL + 'webinar21004/apply').submit();
	}
	else {
		$('#frm_webinar').prop('action', SITE_URL + 'webinar21004/complete').submit();
	}
}
