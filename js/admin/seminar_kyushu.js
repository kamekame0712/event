var wk_apply_id;

jQuery( function($) {
	wk_apply_id = '';

	$('#tbl_seminar_kyushu').bootgrid({
		ajax: true,
		url: SITE_URL + 'admin/seminar_kyushu/get_bootgrid',
		formatters: {
			'col_proc': function(column, row) {
				return '<a href="javascript:void(0);" onclick="cancel_apply(' + row.apply_id + ',\'' + row.juku_name + '\')">'
					 + '<i class="fas fa-ban"></i>&nbsp;キャンセル'
			}
		},
		rowCount: [15, 30, 50, -1],
		labels: {
			search: '塾名で検索'
		}
	})
	.on('loaded.rs.jquery.bootgrid', function(e) {
		flg_tbl_show = true;
		$('.search').css('display', 'none');
	});
});

function cancel_apply(apply_id, juku_name)
{
	wk_apply_id = apply_id;
	$('#juku_name').html(juku_name);
	$('#modal_seminar_kyushu').modal();
}

function do_submit()
{
	$.ajax({
		url: SITE_URL + 'admin/seminar_kyushu/ajax_cancel',
		type:'post',
		cache:false,
		data: {
			apply_id: wk_apply_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['status'] ) {
			$('#modal_seminar_kyushu').modal('hide');
			$('#tbl_seminar_kyushu').bootgrid('reload');
		}
		else {
			show_error_notification(ret['err_msg']);
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}
