$('#event_date').datepicker({
	dateFormat: 'yy-mm-dd'
});

$('[name^="exhibition_time_start"], [name^="exhibition_time_end"]').timepicker({
	step: 10,
	timeFormat: 'H:i',
	minTime: '09:30',
	maxTime: '16:00'
});
