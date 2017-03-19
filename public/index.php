<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$setting = include __DIR__ . '/../app/settings.php';

$app = new \Slim\App($setting);

include __DIR__ . '/../app/container.php';
include __DIR__ . '/../app/routing.php';

$app->run();

?>