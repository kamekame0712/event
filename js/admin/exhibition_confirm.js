function do_submit(proc, kind, eid)
{
	if( proc == '1' ) {
		if( kind == 'add' ) {
			$('#frm_exhibition').prop('action', SITE_URL + 'admin/exhibition/add').submit();
		}
		else {
			$('#frm_exhibition').prop('action', SITE_URL + 'admin/exhibition/mod/' + eid).submit();
		}
	}
	else {
		$('#frm_exhibition').prop('action', SITE_URL + 'admin/exhibition/complete').submit();
	}
}
