$(document).ready(function() {
	$('#FooChangePassword').on('click', function () {
		var chkbox_user_password = $('#FooChangePassword');

		if (chkbox_user_password.is(':checked')) {
			 $('#UserUserpassword').attr('disabled',false);
		} else {
			 $('#UserUserpassword').attr('disabled',true);
		}
		
	});
});