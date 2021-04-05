var wk_apply_id;

function cancel_apply(apply_id, place, juku_name)
{
	wk_apply_id = apply_id;
	$('#place').html(place);
	$('#juku_name').val(juku_name).prop('disabled', true);
	$('#modal_apply').modal();
}

function do_submit()
{
	$.ajax({
		url: SITE_URL + 'admin/seminar/ajax_cancel',
		type:'post',
		cache:false,
		data: {
			apply_id: wk_apply_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['status'] ) {
			$('#modal_apply').modal('hide');
			location.reload();
		}
		else {
			show_error_notification(ret['err_msg']);
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}
