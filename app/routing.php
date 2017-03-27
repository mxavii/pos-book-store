<?php

use App\Middlewares\AdminMiddleware;

$namespace = 'App\Controllers';

// Router Sign In -------------------------------------------------------------
$app->get('/', $namespace . '\UserController:getSignIn')
	->setName('user.signin');
$app->post('/', $namespace . '\UserController:postSignIn');

// Router Sign Out ------------------------------------------------------------
$app->get('/user/signout', $namespace . '\UserController:getSignOut')
	->setName('user.signout');

$app->group('', function () use ($app,$namespace) {
	$app->get('/home', $namespace . '\HomeController:index')->setName('home');

	// Product ----------------------------------------------------------------
	$app->get('/product/add', $namespace . '\ProductController:getAdd')
		->setName('product.add');
	$app->post('/product/add', $namespace . '\ProductController:postAdd')
		->setName('product.add.post');
	$app->get('/product', $namespace . '\ProductController:getActiveProduct')
		->setName('product.active');
	$app->get('/product/inactive', 
		$namespace . '\ProductController:getInactiveProduct')
		->setName('product.inactive');
	$app->post('/product/active', 
		$namespace . '\ProductController:setInactive')
		->setName('product.set.inactive');
	$app->post('/product/list/muldel', 
		$namespace . '\ProductController:setDelete')
		->setName('product.inactive.post');
	$app->get('/product/list/activated/{id}', 
		$namespace . '\ProductController:setActive');
	$app->get('/product/list/edit/{id}', 
		$namespace . '\ProductController:getEdit')
		->setName('product.edit');
	$app->post('/product/list/edit/{id}', 
		$namespace . '\ProductController:setUpdate')
		->setName('product.edit.post');

	// Sale -------------------------------------------------------------------
	$app->get('/sale', $namespace . '\SaleController:index')
		->setName('sale');
	$app->get('/sale/pay', $namespace . '\SaleController:pay')
		->setName('sale.pay');
	$app->get('/sale/add/{id}/{quantity}', $namespace . '\SaleController:add')
		->setName('sale.add');
	$app->get('/sale/delete/{id}', $namespace . '\SaleController:remove')
		->setName('sale.del.id');
	$app->get('/sale/clear', $namespace . '\SaleController:clear')
		->setName('sale.discard');

	// Router Profile ---------------------------------------------------------
	$app->get('/user/profile', $namespace . '\UserController:getProfile')
		->setName('user.profile');
	$app->get('/user/admin', $namespace . '\ProfileController:getAdmin')
		->setName('user.admin');

	// Router ListUser --------------------------------------------------------
	$app->get('/user/listuser', $namespace . '\ProfileController:getProfileUser')
		->setName('user.listuser');
	$app->get('/user/del/{id}', $namespace . '\ProfileController:softDelete')
		->setName('user.del');
	$app->get('/user/edit/{id}', $namespace . '\ProfileController:getEditUser')
		->setName('user.edit');
	$app->post('/user/edit/{id}', 
		$namespace . '\ProfileController:postEditUser')
		->setName('user.edit.post');

	// Router Add User --------------------------------------------------------
	$app->get('/user/adduser', $namespace . '\ProfileController:getAddUser')
		->setName('user.adduser');
	$app->post('/user/adduser', $namespace . '\ProfileController:postAddUser');

	// Router get trash user --------------------------------------------------
	$app->get('/user/trashuser', $namespace . '\ProfileController:getAllTrash')
		->setName('user.trashuser');
	$app->get('/user/delete/{id}', 
		$namespace . '\ProfileController:hardDelete')->setName('user.delete');
	$app->get('/user/restore/{id}', 
		$namespace . '\ProfileController:restoreData')
		->setName('user.restore');

})->add(new AdminMiddleware($container));