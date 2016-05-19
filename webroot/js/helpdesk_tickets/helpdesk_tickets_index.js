$(document).ready(function () {

	$("#dialog-modal").dialog({
		autoOpen: false,
		height: 650,
		width: 800,
		position: ['center', 8],
		modal: true,
		buttons: {
			Close: function () {
				$(this).dialog('close');
			}
		}
	});

	$('.ticket-detail').on('click', function () {
		var attr_id = $(this).attr('id');
		var ticket_id = attr_id.split("-")[1];

		spinner.spin(target);

		$.ajax({
			url: base_url+'data_service/ticket/'+ticket_id,
			type: 'GET',
			dataType: 'json',
			data: {}
		}).done(function(data) {
			spinner.stop(target);

			$('#dialog-content').html(data.content);
			$("#dialog-modal").dialog("open");
			
		}).fail(function(data) {
			alert('Failed requesting data');
		});

	});

});

function ticket_status(obj)
{
	var sel = $('#ticket_status :selected');
	var ta_sol = $('#solution');

	if (sel.val() == 2) {
		ta_sol.attr('disabled', false);
	} else {
		ta_sol.attr('disabled', true);
	}
}

function save_changes()
{
	var target2 = document.getElementById('loading');
	var spinner2 = new Spinner({top: 'auto', left: 'auto'});
	spinner2.spin(target2);

	var sel = $('#ticket_status :selected');
	var ta_sol = $.trim($('#solution').val());

	$.ajax({
		url: base_url+'helpdesk_tickets/ajax_ticket_process',
		type: 'POST',
		dataType: 'json',
		data: {
			ticket_status: sel.val(),
			solution_desc: ta_sol.length == 0 ? 'null' : ta_sol,
			priority: $('#hide_priority').val(),
			modified_by: $('#hide_created_by').val(),
			ticket_id: $('#hide_ticket_id').val(),
			ticket_number: $('#hide_ticket_number').val()
		}
	}).done(function(data) {
		spinner2.stop(target2);
		alert(data.resp);

		// Request to refresh
		$.ajax({
			url: base_url+'data_service/ticket/'+$('#hide_ticket_id').val(),
			type: 'GET',
			dataType: 'json',
			data: {}
		}).done(function(data) {
			$('#dialog-modal').html(data.content);
		}).fail(function(data) {
			alert('Failed requesting data');
		});

	}).fail(function(data) {
		alert('Failed requesting data');
	});
}