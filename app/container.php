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



	$view->getEnvironment()->addGlobal('old', @$_SESSION['old']);
	unset($_SESSION['old']);
	$view->getEnvironment()->addGlobal('errors', @$_SESSION['errors']);
	unset($_SESSION['errors']);

	if (@$_SESSION['user']) {
		$view->getEnvironment()->addGlobal('user', $_SESSION['user']);
	}
   var_dump($_SESSION['user']);


	$view->getEnvironment()->addGlobal('flash', $c->flash);

	return $view;
};

$container['validation'] = function ($c) {
	$setting = $c->get('settings')['lang'];

	$param = $c['request']->getParams();

	return new \Valitron\Validator($param, [], $setting['default']);
};

$container['flash'] = function ($c) {
	return new \Slim\Flash\Messages;
}

?>
