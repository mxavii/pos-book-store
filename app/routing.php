<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');

// Product ------------------------------------------------
$app->get('/product/add', 'App\Controllers\ProductController:getAdd')->setName('product.add');
$app->post('/product/add', 'App\Controllers\ProductController:postAdd')->setName('product.add.post');
$app->get('/product', 'App\Controllers\ProductController:getActiveProduct')->setName('product.active');
$app->get('/product/inactive', 'App\Controllers\ProductController:getInactiveProduct')->setName('product.inactive');
$app->post('/product/active', 'App\Controllers\ProductController:setInactive')->setName('product.set.inactive');
$app->post('/product/list/muldel', 'App\Controllers\ProductController:setDelete')->setName('product.inactive.post');
$app->get('/product/list/activated/{id}', 'App\Controllers\ProductController:setActive');
$app->get('/product/list/edit/{id}', 'App\Controllers\ProductController:getEdit')->setName('product.edit');
$app->post('/product/list/edit/{id}', 'App\Controllers\ProductController:setUpdate')->setName('product.edit.post');

// User ------------------------------------------------
$app->get('/user/signup', 'App\Controllers\UserController:getSignUp')->setName('user.signup');
$app->post('/user/signup', 'App\Controllers\UserController:postSignUp');
$app->get('/user/signin', 'App\Controllers\UserController:getSignIn')->setName('user.signin');
$app->post('/user/signin', 'App\Controllers\UserController:postSignIn');

// Sale ---------------------------------------------
$app->get('/order', 'App\Controllers\SaleController:index')->setName('sale');
$app->get('/order/pay', 'App\Controllers\SaleController:pay')->setName('sale.pay');
$app->get('/order/add/{id}/{quantity}', 'App\Controllers\SaleController:add')->setName('sale.add');
$app->get('/order/delete/{id}', 'App\Controllers\SaleController:remove')->setName('sale.del.id');
$app->get('/order/clear', 'App\Controllers\SaleController:clear')->setName('sale.discard');
