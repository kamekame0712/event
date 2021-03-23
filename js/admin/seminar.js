var flg_proc;
var wk_seminar_id;

jQuery( function($) {
	flg_proc = 0;
	wk_seminar_id = '';

	$('#tbl_seminar').bootgrid({
		ajax: true,
		url: SITE_URL + 'admin/seminar/get_bootgrid',
		formatters: {
			'col_proc': function(column, row) {
				return '<a href="javascript:void(0);" onclick="mod_seminar(' + row.seminar_id + ',\'' + row.office_id + '\',\'' + row.place_id + '\',\'' + row.event_date_data + '\',\'' + row.capacity + '\')">'
					 + '<i class="fas fa-pencil-alt"></i>&nbsp;修正</a>&nbsp;&nbsp;&nbsp;'
					 + '<a href="javascript:void(0);" onclick="del_seminar(' + row.seminar_id + ',\'' + row.office_id + '\',\'' + row.place_id + '\',\'' + row.event_date_data + '\',\'' + row.capacity + '\')">'
					 + '<i class="far fa-trash-alt"></i>&nbsp;削除</a>&nbsp;&nbsp;&nbsp;'
					 + '<a href="' + SITE_URL + 'admin/seminar/dl/' + row.seminar_id + '"'
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
});

$('#event_date').datepicker({
	dateFormat: 'yy-mm-dd'
});

function add_seminar()
{
	flg_proc = 1;
	$('#office').val('').prop('disabled', false);
	$('#place').val('').prop('disabled', false);
	$('#event_date').val('').prop('disabled', false);
	$('#capacity').val('').prop('disabled', false);
	$('#modal_seminar_title').html('新規追加');
	$('#btn_submit').html('新規追加');
	$('#modal_seminar').modal();
}

function mod_seminar(seminar_id, office_id, place_id, event_date, capacity)
{
	flg_proc = 2;
	wk_seminar_id = seminar_id;
	$('#office').val(office_id).prop('disabled', false);
	$('#place').val(place_id).prop('disabled', false);
	$('#event_date').val(event_date).prop('disabled', false);
	$('#capacity').val(capacity).prop('disabled', false);
	$('#modal_seminar_title').html('修正');
	$('#btn_submit').html('修正');
	$('#modal_seminar').modal();
}

function del_seminar(seminar_id, office_id, place_id, event_date, capacity)
{
	var flg_submit = true;

	$.ajax({
		url: SITE_URL + 'admin/seminar/ajax_chk_applied',
		type:'post',
		cache:false,
		data: {
			seminar_id: seminar_id
		}
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['flg_exists'] ) {
			if( !confirm('申込データが存在します。本当に削除しますか？' + "\r\n" + '（申込データも削除します。）') ) {
				flg_submit = false;
			}
		}

		if( flg_submit ) {
			flg_proc = 3;
			wk_seminar_id = seminar_id;
			$('#office').val(office_id).prop('disabled', true);
			$('#place').val(place_id).prop('disabled', true);
			$('#event_date').val(event_date).prop('disabled', true);
			$('#capacity').val(capacity).prop('disabled', true);
			$('#modal_seminar_title').html('削除');
			$('#btn_submit').html('削除');
			$('#modal_seminar').modal();
		}
	})
	.fail( function(data, textStatus, errorThrown) {
		show_error_notification(textStatus);
	});
}

function do_submit()
{
	var ajax_url = '';
	var ajax_data = {};

	switch( flg_proc ) {
		case 1: // 新規追加
			ajax_url = SITE_URL + 'admin/seminar/ajax_add';
			ajax_data = {
				office: $('#office').val(),
				place: $('#place').val(),
				event_date: $('#event_date').val(),
				capacity: $('#capacity').val()
			};
			break;

		case 2: // 更新
			ajax_url = SITE_URL + 'admin/seminar/ajax_mod';
			ajax_data = {
				seminar_id: wk_seminar_id,
				office: $('#office').val(),
				place: $('#place').val(),
				event_date: $('#event_date').val(),
				capacity: $('#capacity').val()
			};
			break;

		case 3: // 削除
			ajax_url = SITE_URL + 'admin/seminar/ajax_del';
			ajax_data = {
				seminar_id: wk_seminar_id
			};
			break;

		default:
			show_error_notification('処理が完了できませんでした。');
			return false;
	}

	$.ajax({
		url: ajax_url,
		type:'post',
		cache:false,
		data: ajax_data
	})
	.done( function(ret, textStatus, jqXHR) {
		if( ret['status'] ) {
			$('#modal_seminar').modal('hide');
			$('#tbl_seminar').bootgrid('reload');
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
