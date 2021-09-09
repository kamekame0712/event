jQuery( function($) {
	$('#tbl_winter21').bootgrid({
		ajax: true,
		url: SITE_URL + 'admin/winter21/get_bootgrid',
		formatters: {
			'col_proc': function(column, row) {
				return '<a href="' + SITE_URL + 'admin/winter21/apply_confirm/' + row.exhibition_id + '"'
					 + '<i class="far fa-check-square"></i>&nbsp;確認</a>&nbsp;&nbsp;&nbsp;'
					 + '<a href="' + SITE_URL + 'admin/winter21/dl/' + row.exhibition_id + '"'
					 + '<i class="fas fa-download"></i>&nbsp;ダウンロード</a>'
			}
		},
		rowCount: [15, 30, 50, -1],
		labels: {
			search: ''
		}
	})
	.on('loaded.rs.jquery.bootgrid', function(e) {
		$('.search').css('display', 'none');
	});
});
