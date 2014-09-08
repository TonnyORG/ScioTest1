$(document).ready(function() {
	// Add User Button
	$('#window-users .add input[name="add"]').on('click', function(e) {
		e.preventDefault();
		var responseObj = $('#window-users .add .response');
		showLoading();
		var user_name = $('#window-users .add label input[name="user_name"]').val().trim();
		$.post($(this).parent().attr('action'), {user_name: user_name})
		.always(function () {
			hideLoading();
		})
		.done(function(data) {
			console.log(data);
			if(data != null) {
				updateResponse(responseObj, 'Usuario agregado correctamente.', 'green');
				$('#window-users .add input[name="reset"]').click();
				getUsers();
			} else {
				updateResponse(responseObj, 'El nombre de usuario ya está ocupado.', 'red');
			}
		})
		.fail(function() {
			updateResponse(responseObj, 'Error de conexión.', 'red');
		});
	});

	// Filter User Button
	$('#window-users .view input[name="view"]').on('click', function(e) {
		e.preventDefault();
		var per_page = parseInt($('#window-users .view input[name="per_page"]').val().trim());
		if (isNaN(per_page)) {
			per_page = 10;
		}
		var page = parseInt($('#window-users .view input[name="page"]').val().trim());
		if (isNaN(page)) {
			page = 1;
		}
		var filter = $('#window-users .view select[name="filter"]').find(":selected").val();
		var order = $('#window-users .view select[name="order"]').find(":selected").val();
		getUsers(per_page, page, filter, order);
	});

	// Cancel Edit User Button
	$('#window-users .edit input[name="reset"]').on('click', function(e) {
		$('#window-users .edit').slideUp();
		$('#window-users .edit .response').html('');
		$('#window-users .edit input[type="hidden"]').removeAttr('value');
	});

	// Edit User Button
	$('#window-users .edit input[name="edit"]').on('click', function(e) {
		e.preventDefault();
		var responseObj = $('#window-users .edit .response');
		var mainResponseObj = $('#window-users .add .response');
		showLoading();
		var user_id = $('#window-users .edit input[name="user_id"]').val();
		var user_name = $('#window-users .edit label input[name="user_name"]').val();
		$.post($(this).parent().attr('action')+user_id, { user_id: user_id, user_name: user_name })
		.always(function () {
			hideLoading();
		})
		.done(function(data) {
			if(data != null) {
				updateResponse(mainResponseObj, 'Usuario actualizado correctamente.', 'green');
				$('#window-users .edit input[name="reset"]').click();
				getUsers();
			} else {
				updateResponse(responseObj, 'El nombre de usuario ya está ocupado.', 'red');
			}
		})
		.fail(function() {
			updateResponse(responseObj, 'Error de conexión.', 'red');
		});
	});

	// Delete User Link
	$('#window-users .edit a').on('click', function(e) {
		e.preventDefault();
		var responseObj = $('#window-users .edit .response');
		var mainResponseObj = $('#window-users .add .response');
		showLoading();
		var user_id = $('#window-users .edit input[name="user_id"]').val();
		$.post($(this).attr('href')+user_id)
		.always(function () {
			hideLoading();
		})
		.done(function(data) {
			if(data == true) {
				updateResponse(mainResponseObj, 'Usuario eliminado correctamente.', 'green');
				$('#window-users .edit input[name="reset"]').click();
				getUsers();
			} else {
				updateResponse(responseObj, 'No se pudo borrar el usuario.', 'red');
			}
		})
		.fail(function() {
			updateResponse(responseObj, 'Error de conexión.', 'red');
		});
	});
});