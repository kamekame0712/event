jQuery( function($) {
	flg_proc = 0;
	wk_seminar_id = '';

	$('#tbl_webinar21004').bootgrid({
		ajax: true,
		url: SITE_URL + 'admin/webinar21004/get_bootgrid',
		formatters: {
			'col_proc': function(column, row) {
				return '<a href="javascript:void(0);" onclick="cancel_apply(' + row.apply_webinar21004_id + ')"><i class="fas fa-trash-alt"></i>&nbsp;キャンセル</a>';
			}
		},
		rowCount: [15, 30, 50, -1],
		labels: {
			search: '塾名で検索'
		}
	});
});

// キャンセル
function cancel_apply(apply_webinar21004_id)
{
	if( confirm('本当にキャンセルしますか？' + "\r\n" + 'キャンセルすると元には戻せません。') ) {
		$.ajax({
			url: SITE_URL + 'admin/webinar21004/ajax_cancel_apply',
			type:'post',
			cache:false,
			data: {
				apply_webinar21004_id: apply_webinar21004_id
			}
		})
		.done( function(ret, textStatus, jqXHR) {
			if( ret['status'] ) {
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
}
