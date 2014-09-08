<?php

// Index
$app->get('/', function () use ($app) {
	$app->response->headers->set('Content-Type', 'text/html; charset=utf-8');
    $app->render('home.php');
});

// Group All API calls
$app->group('/api', function () use ($app) {
	// Additional Configuration
	$app->response->headers->set('Content-Type', 'application/json');
	$response = new stdClass;

	// Stats
	$app->get('/stats', function () use ($app, $response) {
		$response->users = UserController::countAll();
		$response->comments = CommentController::countAll();
		$app->response->setBody(json_encode($response));
	});

	// User Routes
	$app->group('/users', function () use ($app, $response) {
		// Add new user
		$app->post('/add', function () use ($app, $response) {
			$response = UserController::postAdd($app->request->post());
			$app->response->setBody(json_encode($response));
		});

		// Edit user
		$app->post('/edit/:id', function ($id) use ($app, $response) {
			$response = UserController::postEdit($id, $app->request->post());
			$app->response->setBody(json_encode($response));
		});

		// Delete user
		$app->post('/delete/:id', function ($id) use ($app, $response) {
			$response = UserController::postDelete($id);
			$app->response->setBody($response);
		});

		// Retrieve user's list filtered by post per page, page number and ordered by certain field
		$app->get('/:per_page/:page/:field/:order', function ($per_page, $page, $field, $order) use ($app, $response) {
			$response = UserController::getAll($per_page, $page, $field, $order);
			$app->response->setBody(json_encode($response));
		});

		// Retrieve user's list filtered by post per page, page number and ordered by certain field asc
		$app->get('/:per_page/:page/:field', function ($per_page, $page, $field) use ($app, $response) {
			$response = UserController::getAll($per_page, $page, $field);
			$app->response->setBody(json_encode($response));
		});

		// Retrieve user's list filtered by post per page and page number
		$app->get('/:per_page/:page', function ($per_page, $page) use ($app, $response) {
			$response = UserController::getAll($per_page, $page);
			$app->response->setBody(json_encode($response));
		});

		// Retrieve user's list filtered by post per page
		$app->get('/:per_page', function ($per_page) use ($app, $response) {
			$response = UserController::getAll($per_page);
			$app->response->setBody(json_encode($response));
		});

		// Retrieve up to 10 users
		$app->get('/', function () use ($app, $response) {
			$response = UserController::getAll();
			$app->response->setBody(json_encode($response));
		});
	});
});