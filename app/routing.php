<?php

$app->get('/home', 'App\Controllers\HomeController:index')->setName('home');

$app->get('/product/add', 'App\Controllers\ProductController:getAdd')->setName('product.add');

$app->post('/product/add', 'App\Controllers\ProductController:postAdd')->setName('product.add.post');

$app->get('/product', 'App\Controllers\ProductController:getActiveProduct')->setName('product.active');

$app->get('/product/inactive', 'App\Controllers\ProductController:getInactiveProduct')->setName('product.inactive');

$app->post('/product/active', 'App\Controllers\ProductController:setInactive')->setName('product.set.inactive');

$app->post('/product/list/muldel', 'App\Controllers\ProductController:setDelete')->setName('product.inactive.post');

$app->get('/product/list/activated/{id}', 'App\Controllers\ProductController:setActive');

$app->get('/product/list/edit/{id}', 'App\Controllers\ProductController:getEdit')->setName('product.edit');

$app->post('/product/list/edit/{id}', 'App\Controllers\ProductController:setUpdate')->setName('product.edit.post');


//Router Sign Up
// $app->get('/user/signup', 'App\Controllers\UserController:getSignUp')->setName('user.signup');
// $app->post('/user/signup', 'App\Controllers\UserController:postSignUp');


// Router Sign In
$app->get('/', 'App\Controllers\UserController:getSignIn')->setName('user.signin');

$app->post('/', 'App\Controllers\UserController:postSignIn');


// Router Sign Out
$app->get('/user/signout', 'App\Controllers\UserController:getSignOut')->setName('user.signout');


// Router Profile
$app->get('/user/profile', 'App\Controllers\UserController:getProfile')->setName('user.profile');

$app->get('/user/admin', 'App\Controllers\ProfileController:getAdmin')->setName('user.admin');

// Router ListUser
$app->get('/user/listuser', 'App\Controllers\ProfileController:getProfileUser')->setName('user.listuser');

$app->get('/user/del/{id}', 'App\Controllers\ProfileController:softDelete')->setName('user.del');

$app->get('/user/edit/{id}', 'App\Controllers\ProfileController:getEditUser')->setName('user.edit');

$app->post('/user/edit/{id}', 'App\Controllers\ProfileController:postEditUser')->setName('user.edit.post');


// Router  Add User
$app->get('/user/adduser', 'App\Controllers\ProfileController:getAddUser')->setName('user.adduser');

$app->post('/user/adduser', 'App\Controllers\ProfileController:postAddUser');


// Router get trash user
$app->get('/user/trashuser', 'App\Controllers\ProfileController:getAllTrash')->setName('user.trashuser');

$app->get('/user/delete/{id}', 'App\Controllers\ProfileController:hardDelete')->setName('user.delete');

$app->get('/user/restore/{id}', 'App\Controllers\ProfileController:restoreData')->setName('user.restore');
