<?php
<<<<<<< HEAD
// Bootstrap application
$app = require __DIR__ . '/../app/bootstrap.php';

// Load the controllers
require __DIR__.'/../src/app.php';
=======

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

// definitions
$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});
>>>>>>> 062d8c74372ab30765638185db77b26e1ce8c2ac

$app->run();