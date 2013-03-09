<?php
// Bootstrap application
$app = require __DIR__ . '/../app/bootstrap.php';

// Load the controllers
require __DIR__.'/../src/app.php';

$app->run();