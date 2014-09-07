$(document).ready(function() {
	// Options
	$('#header .options ul li a').on('click', function(e) {
		e.preventDefault();
		updateWindows($(this).attr('href'));
	});

	// Active First Window
	$('#header .options ul li:first-child a').click();

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

			if(id=='#window-home' ) {
				updateStats();
			} else if(id=='') {
			}
		}
	}

	// Update Stats Function
	function updateStats() {
		showLoading();
		$.getJSON('/stats', function() {
			console.log('Peticion saliente a /stats');
		})
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
});