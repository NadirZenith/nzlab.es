<?php

umask(0000);

require_once __DIR__ . '/../app/bootstrap.php.cache';
require_once __DIR__ . '/../app/AppKernel.php';

$environment = getenv('PACKAGE_ENV');
$debug = false;
if ((int)getenv('PACKAGE_DEBUG')) {
    ini_set('xdebug.max_nesting_level', 500);
    $debug = true;
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && preg_match('/\bhttps\b/i', $_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    //http://stackoverflow.com/questions/20674567/redirect-loop-on-any-url-with-https-in-symfony2 (PRE)
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

$request = Sonata\PageBundle\Request\RequestFactory::createFromGlobals('host_with_path');

$kernel = new AppKernel($environment, $debug);

$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);
