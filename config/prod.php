<?php

// configure your app for the production environment
require_once __DIR__.'/data.php';

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => false);
