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
	$app->get('/product/add',
		$namespace . '\CategoryController:getAllCategory')
		->setName('product.add');
	$app->post('/product/add',
		$namespace . '\ProductController:postAdd')
		->setName('product.add.post');

	$app->get('/product',
		$namespace . '\ProductController:getActiveProduct')
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
		$namespace . '\ProductController:setActive')
		->setName('product.activated');

	$app->get('/product/list/edit/{id}',
		$namespace . '\ProductController:getEdit')
		->setName('product.edit');
	$app->post('/product/list/edit/{id}',
		$namespace . '\ProductController:setUpdate')
		->setName('product.edit.post');

	// Category ---------------------------------------------------------------
	$app->get('/category/listcategory',
		$namespace . '\CategoryController:getAll')
		->setName('category.listcategory');

	$app->get('/category/del/{id}',
		$namespace . '\CategoryController:softDelete')
		->setName('category.del');

	$app->get('/category/addcategory',
		$namespace . '\CategoryController:getAddCategory')
		->setName('category.addcategory');
	$app->post('/category/addcategory',
		$namespace . '\CategoryController:postAddCategory');

	$app->get('/category/trashcategory',
		$namespace . '\CategoryController:getAllTrash')
		->setName('category.trashcategory');

	$app->get('/category/delete/{id}',
		$namespace . '\CategoryController:hardDelete')
		->setName('category.delete');

	$app->get('/category/restore/{id}',
		$namespace . '\CategoryController:restoreData')
		->setName('category.restore');

	$app->get('/category/edit/{id}',
		$namespace . '\CategoryController:getEditCategory')
		->setName('category.edit');
	$app->post('/category/edit/{id}',
		$namespace . '\CategoryController:postEditCategory')
		->setName('category.edit.post');

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
	$app->get('/user/admin', $namespace . '\UserController:getAdmin')
		->setName('user.admin');

	// Router ListUser --------------------------------------------------------
	$app->get('/user/listuser',
		$namespace . '\UserController:getProfileUser')
		->setName('user.listuser');
	$app->get('/user/del/{id}', $namespace . '\UserController:softDelete')
		->setName('user.del');
	$app->get('/user/edit/{id}', $namespace . '\UserController:getEditUser')
		->setName('user.edit');
	$app->post('/user/edit/{id}',
		$namespace . '\UserController:postEditUser')
		->setName('user.edit.post');

	// Router Add User --------------------------------------------------------
	$app->get('/user/adduser', $namespace . '\UserController:getAddUser')
		->setName('user.adduser');
	$app->post('/user/adduser', $namespace . '\UserController:postAddUser');

	// Router get trash user --------------------------------------------------
	$app->get('/user/trashuser', $namespace . '\UserController:getAllTrash')
		->setName('user.trashuser');
	$app->get('/user/delete/{id}',
		$namespace . '\UserController:hardDelete')->setName('user.delete');
	$app->get('/user/restore/{id}',
		$namespace . '\UserController:restoreData')
		->setName('user.restore');

})->add(new AdminMiddleware($container));
