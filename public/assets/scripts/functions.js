// Update Windows Function
function updateWindows(id) {
	if(!$('#content '+id).hasClass('active')) {
		var active = $('#content .window.active');
		var target = $('#content .window'+id);
		if(active.length > 0) {
			active.slideToggle(400, function() {
				if(active.length > 0) {
					active.removeClass('active');
					active.removeAttr('style');
				}
				target.slideToggle();
				target.addClass('active')
			});
		} else {
			target.slideToggle();
			target.addClass('active')
		}

		if(id == '#window-home' ) {
			getStats();
		} else if(id == '#window-users') {
			getUsers();
		} else if(id == '#window-comments') {
			getAuthors();
			getComments();
		}
	}
}

// Update Stats Function
function getStats() {
	showLoading();
	$.getJSON('/api/stats')
	.always(function () {
		hideLoading();
	})
	.done(function(data) {
		$('#window-home .users .value').html(data.users);
		$('#window-home .comments .value').html(data.comments);
	})
	.fail(function() {
		$('#window-home .users .value').html('Error de Conexión');
		$('#window-home .comments .value').html('Error de Conexión');
	});
}

// Retrieve all users
function getUsers(per_page, page, field, order) {
	per_page = '/'+per_page || '';
	page = '/'+page || '';
	field = '/'+field || '';
	order = '/'+order || '';

	var url = '/api/users'+per_page+page+field+order;
	$('#window-users .list').html('');
	showLoading();
	$.getJSON(url)
	.always(function () {
		hideLoading();
	})
	.done(function(data) {
		if(data.length > 0) {
			$.each(data, function(key, value) {
				$('#window-users .list').append('<li><a href="#'+value.UserId+'">'+value.UserName+'</a></li>');
			});
			$.each($('#window-users .list li a'), function() {
				$(this).on('click', function(e) {
					e.preventDefault();
					$('#window-users .edit input[name="reset"]').click();
					$('#window-users .edit input[name="user_name"]').val($(this).html());
					$('#window-users .edit input[name="user_id"]').val($(this).attr('href').toString().replace('#', ''));
					$('#window-users .edit').slideDown();
				});
			});
		} else {
			$('#window-users .list').html('<li>No hay usuarios registrados.</li>');
		}
	})
	.fail(function() {
		$('#window-users .list').html('<li>Error de conexión.</li>');
	});
}

// Retrieve all users
function getAuthors() {
	var url = '/api/users/0/1/UserName';
	$('#window-comments .add select[name="user_id"] option:not(:first-child)').remove();
	$('#window-comments .add select').attr('disabled', 'disabled');
	$('#window-comments .add textarea').attr('disabled', 'disabled');
	$('#window-comments .add input').attr('disabled', 'disabled');
	showLoading();
	$.getJSON(url)
	.always(function () {
		hideLoading();
	})
	.done(function(data) {
		if(data.length > 0) {
			$.each(data, function(key, value) {
				$('#window-comments .add select[name="user_id"]').append('<option value="'+value.UserId+'">'+value.UserName+'</option>');
			});
			$('#window-comments .add select').removeAttr('disabled');
			$('#window-comments .add textarea').removeAttr('disabled');
			$('#window-comments .add input').removeAttr('disabled');
		} else {
			$('#window-comments .textarea').html('No hay usuarios registrados.');
		}
	})
	.fail(function() {
		$('#window-comments .add textarea').html('Error de conexión.');
	});
}

// Retrieve all comments
function getComments(per_page, page, field, order) {
	per_page = '/'+per_page || '';
	page = '/'+page || '';
	field = '/'+field || '';
	order = '/'+order || '';

	var url = '/api/comments'+per_page+page+field+order;
	$('#window-comments .list').html('');
	showLoading();
	$.getJSON(url)
	.always(function () {
		hideLoading();
	})
	.done(function(data) {
		if(data.length > 0) {
			$.each(data, function(key, value) {
				$('#window-comments .list').append('<li><strong>Usuario '+value.UserId+' dijo:</strong> '+value.Comment+' <a href="#'+value.CommentId+'">Borrar</a></li>');
			});
			updateCommentsLinks();
		} else {
			$('#window-comments .list').html('<li>No hay comentarios registrados.</li>');
		}
	})
	.fail(function() {
		$('#window-comments .list').html('<li>Error de conexión.</li>');
	});
}

// Delete Comment Links
function updateCommentsLinks(link) {
	$('#window-comments .list a').on('click', function(e) {
		e.preventDefault();
		var responseObj = $('#window-comments .add .response');
		showLoading();
		var comment_id = $(this).attr('href').replace('#', '').trim();
		$.post('/api/comments/delete/'+comment_id)
		.always(function () {
			hideLoading();
		})
		.done(function(data) {
			if(data == true) {
				updateResponse(responseObj, 'Comentario eliminado correctamente.', 'green');
				$('#window-comments .edit input[name="reset"]').click();
				getComments();
			} else {
				updateResponse(responseObj, 'No se pudo borrar el comentario.', 'red');
			}
		})
		.fail(function() {
			updateResponse(responseObj, 'Error de conexión.', 'red');
		});
	});
}

// Loading Fadding-in
function showLoading() {
	$('.loading').addClass('active');
	$('.loading .loading-dialog').animate({top: '20%'}, 500);
}

// Loading Fadding-out
function hideLoading() {
	$('.loading .loading-dialog').animate({top: '-100%'}, 500, function() {
		$('.loading').removeClass('active');
	});
}

// Generic function to retrieve data from API
/*function getData(url) {
	var response;
	showLoading();
	$.getJSON(url).always(function() {
		hideLoading();
	})
	.done(function(data) {
		response = data;
	})
	.fail(function() {
		response = null;
	});
	return response;
}*/

// Update Response Messages
function updateResponse(responseObject, responseText, responseClass) {
	responseObject.html(responseText);
	responseObject.addClass(responseClass);
	responseObject.css('display', 'block');
	responseObject.fadeOut(5000, function() {
		$(this).removeAttr('style');
		$(this).removeClass(responseClass);
		$(this).html('');
	});
}