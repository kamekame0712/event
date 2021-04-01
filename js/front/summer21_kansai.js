jQuery( function($) {
	var detail_height = parseInt($('#detail_box').height());
	var speaker_height = parseInt($('#speaker_box').height());
	var limit_height = parseInt($('#limit_num').height());
	var newheight;

	if( detail_height + limit_height + 20 > speaker_height ) {
		newheight = detail_height + limit_height + 20 + 10;
	}
	else {
		newheight = speaker_height + 10;
	}

	$('#detail_box').height(newheight);
	$('#limit_num').css('top', ( parseInt(detail_height) + 20 ) + 'px');
});
