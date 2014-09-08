$(document).ready(function() {
	// Add Comment Button
	$('#window-comments .add input[name="add"]').on('click', function(e) {
		e.preventDefault();
		var responseObj = $('#window-comments .add .response');
		showLoading();
		var user_id = $('#window-comments .add label select[name="user_id"]').find(':selected').val().trim();
		var comment = $('#window-comments .add label textarea[name="comment"]').val().trim();
		$.post($(this).parent().attr('action'), {user_id: user_id, comment: comment})
		.always(function () {
			hideLoading();
		})
		.done(function(data) {
			console.log(data);
			if(data != null) {
				updateResponse(responseObj, 'Comentario agregado correctamente.', 'green');
				$('#window-comments .add input[name="reset"]').click();
				getAuthors();
				getComments();
			} else {
				updateResponse(responseObj, 'No se pudo agregar tu comentario.', 'red');
			}
		})
		.fail(function() {
			updateResponse(responseObj, 'Error de conexión.', 'red');
		});
	});

	// Filter Comment Button
	$('#window-comments .view input[name="view"]').on('click', function(e) {
		e.preventDefault();
		var per_page = parseInt($('#window-comments .view input[name="per_page"]').val().trim());
		if (isNaN(per_page)) {
			per_page = 10;
		}
		var page = parseInt($('#window-comments .view input[name="page"]').val().trim());
		if (isNaN(page)) {
			page = 1;
		}
		var filter = $('#window-comments .view select[name="filter"]').find(":selected").val();
		var order = $('#window-comments .view select[name="order"]').find(":selected").val();
		getComments(per_page, page, filter, order);
	});
});