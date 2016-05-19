$(document).ready(function () {
	$('#FooHelpdeskTransactionTypeId').on('change', function () {
		var trx_type_id = $('#FooHelpdeskTransactionTypeId :selected').val();
		var trx_id = $('#FooHelpdeskTransactionId :selected').val();

		spinner.spin(target);

		$.ajax({
			url: base_url+'data_service/transaction_units/'+trx_id+'/'+trx_type_id,
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data) {
			spinner.stop(target);

			var unit_obj = $('#HelpdeskTicketHelpdeskTransactionUnitId');
			var unit_opts = "<option value=\"0\">---</option>\n";

			for (var i = 0; i < data.length; i++) {
				unit_opts += "<option value=\""+data[i].HelpdeskTransactionUnit.id+"\">"+data[i].HelpdeskTransactionUnit.unit_name+"</option>\n";
			}

			unit_obj.html(unit_opts);
			unit_obj.fadeOut();
			unit_obj.fadeIn('slow');

		}).fail(function(data) {
			alert('Failed requesting data');
		});
	});

	$('#HelpdeskTicketHelpdeskTransactionUnitId').on('change', function () {
		var trx_unit_id = $('#HelpdeskTicketHelpdeskTransactionUnitId :selected').val();

		spinner.spin(target);

		$.ajax({
			url: base_url+'data_service/atms/'+trx_unit_id,
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data) {

			var atm_obj = $('#HelpdeskTicketHelpdeskAtmId');

			if (data.is_atms_null == 'no') {
				var slatarget = $('#slatarget');

				$('#HelpdeskTicketSlaDate').val("");

				slatarget.html("");
				slatarget.hide();

				atm_obj.attr('disabled', false);

				atm_obj.html(data.content);
				atm_obj.fadeOut();
				atm_obj.fadeIn('slow');

			} else {
				atm_obj.html("<option value=\"0\">---</option>");
				atm_obj.attr('disabled', true);

				var str_sla_info = "<p style=\"padding:5px; font-size:1.2em;\">SLA: <strong>"+data.content.sla_days+"</strong> working days. This ticket should be solved on: <strong>"+data.content.sla_date_human+"</strong>.</p>";
				var slatarget = $('#slatarget');

				$('#HelpdeskTicketSlaDate').val(data.content.sla_date);

				slatarget.html(str_sla_info);
				slatarget.show();
			}

			spinner.stop(target);

		}).fail(function(data) {
			alert('Failed requesting data');
		});
	});

	$('#HelpdeskTicketHelpdeskAtmId').on('change', function () {
		var trx_unit_id = $('#HelpdeskTicketHelpdeskTransactionUnitId :selected').val();
		var atm_id = $('#HelpdeskTicketHelpdeskAtmId :selected').val();

		spinner.spin(target);

		$.ajax({
			url: base_url+'data_service/sla_info/'+trx_unit_id+'/'+atm_id,
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data) {

			var str_sla_info = "<p style=\"padding:5px; font-size:1.2em;\">SLA: <strong>"+data.content.sla_days+"</strong> working days. This ticket should be solved on: <strong>"+data.content.sla_date_human+"</strong>.</p>";
			var slatarget = $('#slatarget');

			$('#HelpdeskTicketSlaDate').val(data.content.sla_date);

			slatarget.html(str_sla_info);
			slatarget.show();

			spinner.stop(target);

		}).fail(function(data) {
			alert('Failed requesting data');
		});
	});

});