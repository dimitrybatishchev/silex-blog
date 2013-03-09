<?php

use Silex\Provider\FormServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = true;

// Set up the Symfony forms component
$app->register(new FormServiceProvider());

$app->register(new UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider(), array('locale_fallback' => 'en',));

// Set Up Templating
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../web/views',
    'twig.class_path' => __DIR__ . '/../vendor/twig/lib',
    'twig.options'  => array(
        'debug' => true,
        'cache' => false
    ),
));
            
// Set Up Database
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'            => array(
        'driver'    => 'pdo_sqlite',
        'path'      => __DIR__.'/../resources/data.db',
    ),
    'db.dbal.class_path'    => __DIR__.'/../vendor/doctrine-dbal/lib',
    'db.common.class_path'  => __DIR__.'/../vendor/doctrine-common/lib',
));

// Register Doctrine ORM
$app->register(new Nutwerk\Provider\DoctrineORMServiceProvider(), array(
    'db.orm.proxies_dir'           => __DIR__.'/../var/cache/doctrine/Proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.auto_generate_proxies' => true,

    'db.orm.entities'              => array(array(
        'type'      => 'annotation',
        'path'      => __DIR__.'/../src/Blog/Entity',
        'namespace' => 'Blog\Entity',
    )),
));

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/.*',
            'anonymous' => true, // Needed as the login path is under the secured area
            'security' => true,
            'form' => array('login_path' => '/login', 'check_path' => 'login_check'),
            'logout' => array('logout_path' => '/logout'), // url to call for logging out
            'users' => $app->share(function() use ($app) {
                return new Blog\User\DoctrineUserProvider($app['db.orm.em']);
            }),
        ),
    ),
    'security.access_rules' => array(
        array('^/login$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
        array('^/register$', 'IS_AUTHENTICATED_ANONYMOUSLY'),
        array('^/.*', 'ROLE_USER'),      
    )
));
            
return $app;