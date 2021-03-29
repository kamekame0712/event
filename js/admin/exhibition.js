var wk_exhibition_id;

jQuery( function($) {
	wk_exhibition_id = '';

	$('#tbl_exhibition').bootgrid({
		ajax: true,
		url: SITE_URL + 'admin/exhibition/get_bootgrid',
		formatters: {
			'col_proc': function(column, row) {
				return '<a href="javascript:void(0);" onclick="mod_exhibition(' + row.exhibition_id + ')">'
					 + '<i class="fas fa-pencil-alt"></i>&nbsp;修正</a>&nbsp;&nbsp;&nbsp;'
					 + '<a href="javascript:void(0);" onclick="del_exhibition(' + row.exhibition_id + ',\'' + row.office_id + '\',\'' + row.place_id + '\',\'' + row.event_date_data + '\')">'
					 + '<i class="far fa-trash-alt"></i>&nbsp;削除</a>&nbsp;&nbsp;&nbsp;'
					 + '<a href="' + SITE_URL + 'admin/exhibition/dl/' + row.exhibition_id + '"'
					 + '<i class="fas fa-download"></i>&nbsp;ダウンロード</a>'
			},
		},
		rowCount: [15, 30, 50, -1],
		labels: {
			search: '管理者名で検索'
		}
	})
	.on('loaded.rs.jquery.bootgrid', function(e) {
		flg_tbl_show = true;
		$('.search').css('display', 'none');
	});

	if( result == 'ok' ) {
		show_success_notification('処理が完了しました。');
	}
	else if( result == 'err1' ) {
		show_error_notification('データベースエラーが発生しました。');
	}
	else if( result == 'err2' ) {
		show_error_notification('対象の展示会情報が見つかりません。');
	}
});

$('#event_date').datepicker({
	dateFormat: 'yy-mm-dd'
});

function mod_exhibition(exhibition_id)
{
	var flg_submit = true;

	$.ajax({
		url: SITE_URL + 'admin/exhibition/ajax_chk_applied',
		type:'post',
		cache:false,
		data: {
			exhibition_id: exhibition_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['flg_exists'] ) {
			if( !confirm('申込データが存在します。本当に修正しますか？' + "\r\n" + '（申込データは削除されます。）') ) {
				flg_submit = false;
			}
		}

		if( flg_submit ) {
			location.href = SITE_URL + 'admin/exhibition/mod/' + exhibition_id;
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}

function del_exhibition(exhibition_id, office_id, place_id, event_date)
{
	var flg_submit = true;

	$.ajax({
		url: SITE_URL + 'admin/exhibition/ajax_chk_applied',
		type:'post',
		cache:false,
		data: {
			exhibition_id: exhibition_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['flg_exists'] ) {
			if( !confirm('申込データが存在します。本当に削除しますか？' + "\r\n" + '（申込データも削除します。）') ) {
				flg_submit = false;
			}
		}

		if( flg_submit ) {
			wk_exhibition_id = exhibition_id;
			$('#office').val(office_id).prop('disabled', true);
			$('#place').val(place_id).prop('disabled', true);
			$('#event_date').val(event_date).prop('disabled', true);

			$('#modal_exhibition').modal();
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}

function do_submit()
{
	$.ajax({
		url: SITE_URL + 'admin/exhibition/ajax_del',
		type:'post',
		cache:false,
		data: {
			exhibition_id: wk_exhibition_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['status'] ) {
			$('#modal_exhibition').modal('hide');
			$('#tbl_exhibition').bootgrid('reload');
			show_success_notification('処理が完了しました。');
		}
		else {
			show_error_notification(ret['err_msg']);
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}
