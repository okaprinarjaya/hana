$(document).ready(function () {

	$("#dialog-modal").dialog({
		autoOpen: false,
		width: 500,
		position: ['center', 100],
		modal: true,
		buttons: {
			Close: function () {
				$(this).dialog('close');
			}
		}
	});

	$('.pic-list').on('click', function () {

		var attr_id = $(this).attr('id');
		var trx_unit_id = attr_id.split("-")[1];

		spinner.spin(target);

		$.ajax({
			url: base_url+'data_service/pic/'+trx_unit_id,
			type: 'GET',
			dataType: 'json',
			data: {}
		}).done(function(data) {

			spinner.stop(target);

			$('#dialog-modal').html(data.content);
			$("#dialog-modal").dialog("open");
			
		}).fail(function(data) {
			alert('Failed requesting data');
		});

	});

});