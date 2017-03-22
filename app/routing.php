<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');

$app->get('/product/add', 'App\Controllers\ProductController:getAdd')->setName('product.add');

$app->post('/product/add', 'App\Controllers\ProductController:postAdd')->setName('product.add.post');

$app->get('/product', 'App\Controllers\ProductController:getActiveProduct')->setName('product.active');

$app->get('/product/inactive', 'App\Controllers\ProductController:getInactiveProduct')->setName('product.inactive');

$app->post('/product/active', 'App\Controllers\ProductController:setInactive')->setName('product.set.inactive');

$app->post('/product/list/muldel', 'App\Controllers\ProductController:setDelete')->setName('product.inactive.post');

$app->get('/product/list/activated/{id}', 'App\Controllers\ProductController:setActive');

$app->get('/product/list/edit/{id}', 'App\Controllers\ProductController:getEdit')->setName('product.edit');

$app->post('/product/list/edit/{id}', 'App\Controllers\ProductController:setUpdate')->setName('product.edit.post');

?>
