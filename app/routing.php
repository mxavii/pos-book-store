<?php

$app->get('/home', 'App\Controllers\HomeController:index')->setName('home');

$app->get('/product/add', 'App\Controllers\CategoryController:getAllCategory')->setName('product.add');

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

$app->get('/user/admin', 'App\Controllers\UserController:getAdmin')->setName('user.admin');



// Router ListUser
$app->get('/user/listuser', 'App\Controllers\UserController:getProfileUser')->setName('user.listuser');

$app->get('/user/del/{id}', 'App\Controllers\UserController:softDelete')->setName('user.del');

$app->get('/user/edit/{id}', 'App\Controllers\UserController:getEditUser')->setName('user.edit');

$app->post('/user/edit/{id}', 'App\Controllers\UserController:postEditUser')->setName('user.edit.post');


// Router  Add User
$app->get('/user/adduser', 'App\Controllers\UserController:getAddUser')->setName('user.adduser');

$app->post('/user/adduser', 'App\Controllers\UserController:postAddUser');


// Router get trash user
$app->get('/user/trashuser', 'App\Controllers\UserController:getAllTrash')->setName('user.trashuser');

$app->get('/user/delete/{id}', 'App\Controllers\UserController:hardDelete')->setName('user.delete');

$app->get('/user/restore/{id}', 'App\Controllers\UserController:restoreData')->setName('user.restore');

// Router Category
$app->get('/category/listcategory', 'App\Controllers\CategoryController:getAll')->setName('category.listcategory');

$app->get('/category/del/{id}', 'App\Controllers\CategoryController:softDelete')->setName('category.del');

$app->get('/category/addcategory', 'App\Controllers\CategoryController:getAddCategory')->setName('category.addcategory');

$app->post('/category/addcategory', 'App\Controllers\CategoryController:postAddCategory');

$app->get('/category/trashcategory', 'App\Controllers\CategoryController:getAllTrash')->setName('category.trashcategory');

$app->get('/category/delete/{id}', 'App\Controllers\CategoryController:hardDelete')->setName('category.delete');

$app->get('/category/restore/{id}', 'App\Controllers\CategoryController:restoreData')->setName('category.restore');

$app->get('/category/edit/{id}', 'App\Controllers\CategoryController:getEditCategory')->setName('category.edit');

$app->post('/category/edit/{id}', 'App\Controllers\CategoryController:postEditCategory')->setName('category.edit.post');