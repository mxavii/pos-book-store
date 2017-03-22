<?php

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');


//Router Sign Up
$app->get('/user/signup', 'App\Controllers\UserController:getSignUp')->setName('user.signup');
$app->post('/user/signup', 'App\Controllers\UserController:postSignUp');


// Router Sign In
$app->get('/user/signin', 'App\Controllers\UserController:getSignIn')->setName('user.signin');

$app->post('/user/signin', 'App\Controllers\UserController:postSignIn');


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
