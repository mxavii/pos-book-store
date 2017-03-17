<?php

$container = new \Slim\Container;

$container = $app->getContainer();

$container['db'] = function ($c) {
	$setting = $c->get('settings')['db'];
	$config = new \Doctrine\DBAL\Configuration();
	$connectionParams = [
		'dbname'	=>	$setting['name'],
		'user'		=>	$setting['user'],
		'password'	=>	$setting['pass'],
		'host'		=>	$setting['host'],
		'driver'	=>	'pdo_mysql',
	];

	$connection = \Doctrine\DBAL\DriverManager::getConnection(
		$connectionParams, $config);

	return $connection->createQueryBuilder();
};

$container['view'] = function ($c) {
	$setting = $c->get('settings')['view'];
	$view = new \Slim\Views\Twig($setting['path'], $setting['twig']);

	$view->addExtension(new Slim\Views\TwigExtension(
		$c->router, $c->request->getUri())
	);

	return $view;
};

$container['validation'] = function ($c) {
	$setting = $c->get('settings')['lang'];

	$param = $c['request']->getParams();

	return new \Valitron\Validator($param, [], $setting['default']);
};

?>
