<?php
// Index
$app->get('/', function () {
    echo 'hello mother fucker';
});

// Sample Route
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});
?>