<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');


$app->get('/user/signup', 'App\Controllers\UserController:getSignUp')->setName('user.signup');
$app->post('/user/signup', 'App\Controllers\UserController:postSignUp');

// Router Sign In
$app->get('/user/signin', 'App\Controllers\UserController:getSignIn')->setName('user.signin');

$app->post('/user/signin', 'App\Controllers\UserController:postSignIn');

