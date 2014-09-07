<?php

// Index
$app->get('/', function () use ($app) {
    $app->render('home.php');
});

// Stats
$app->get('/stats', function () use ($app) {
	$response = new stdClass;
	$response->users = UserController::countAll();
	$response->comments = CommentController::countAll();
    $app->response->headers->set('Content-Type', 'application/json');
	$app->response->setBody(json_encode($response));
});

// Sample Route
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});