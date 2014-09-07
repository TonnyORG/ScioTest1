<?php

// Index
$app->get('/', function () use ($app) {
    $app->render('home.php');
});

// Sample Route
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});