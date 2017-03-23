<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');

$app->get('/user/signup', 'App\Controllers\UserController:getSignUp')->setName('user.signup');
$app->post('/user/signup', 'App\Controllers\UserController:postSignUp');

// Router Sign In
$app->get('/user/signin', 'App\Controllers\UserController:getSignIn')->setName('user.signin');
$app->post('/user/signin', 'App\Controllers\UserController:postSignIn');


// ---------------------------------------------
$app->get('/order', 'App\Controllers\SaleController:index')->setName('sale');
$app->get('/order/pay', 'App\Controllers\SaleController:pay')->setName('sale.pay');
$app->get('/order/add/{id}/{quantity}', 'App\Controllers\SaleController:add')->setName('sale.add');
$app->get('/order/delete/{id}', 'App\Controllers\SaleController:remove')->setName('sale.del.id');
$app->get('/order/clear', 'App\Controllers\SaleController:clear')->setName('sale.discard');

