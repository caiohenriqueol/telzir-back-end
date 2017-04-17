<?php

require __DIR__ .'/../src/settings.php';

require __DIR__ .'/../vendor/Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim($slimSettings);

require __DIR__.'/../src/middleware.php';
require __DIR__.'/../src/class/FaleMais.php';

$app->group('/api',function() use ($app) {

	$app->get('/', function () use ($app) {
		$app->response->setBody(json_encode(array('time'=>time())));
	});

	require __DIR__.'/../src/routes_telzir.php';
});

$app->run();
