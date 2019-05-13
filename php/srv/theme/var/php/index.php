<?php

$root = dirname(dirname(__DIR__));

require_once $root . '/vendor/autoload.php';

use Templating\Kernel;

$kernel = new Kernel($root . '/var/template', true);

$kernel->registerTemplatingRoues([
    '/'      => 'page/home.html.twig',
    '/theme' => 'page/theme.html.twig',
]);

$kernel->run();
