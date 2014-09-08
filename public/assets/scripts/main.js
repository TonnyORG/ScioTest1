$(document).ready(function() {
	// Options - Init
	$('#header .options ul li a').on('click', function(e) {
		e.preventDefault();
		updateWindows($(this).attr('href'));
	});

	// Active First Window
	$('#header .options ul li:first-child a').click();
});