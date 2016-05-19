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
			var unit_obj = $('#HelpdeskSlaHelpdeskTransactionUnitId');
			var unit_opts = "";

			spinner.stop(target);

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
});