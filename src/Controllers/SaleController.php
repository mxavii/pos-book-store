<?php

namespace App\Controllers;

use App\Models\ProductModel;

class SaleController extends AbstractController
{
	public function index($requests, $response)
	{
		$sale = new ProductModel($this->db);

		$products = $sale->getAll();

		return $this->view->render($response, 'cart/index.twig', [
			'products' => $products
		]);
	}

	public function add($request, $response, $args)
	{
		$product = new ProductModel($this->db);

		$products = $product->where('id', $args['id']);
		// var_dump($products);
		// exit();
		if (!$products) {
			return $response->withRedirect($this->router->pathFor('sale'));
		}
		
		$this->basket->add($products, $args['quantity']);

		return $response->withRedirect($this->router->pathFor('sale'));
	}

	public function remove($request, $response, $args)
	{
		$this->basket->remove($args['id']);
		return $response->withRedirect($this->router->pathFor('sale'));
	}

	public function clear($request, $response)
	{
		$this->basket->clear();
		return $response->withRedirect($this->router->pathFor('sale'));

	}

	// public function addCart($request, $response, $args)
	// {
	// 	$products = new SaleModel($this->db);

	// 	$product = $products->getById($args['id']);

	// 	$session = $this->session->set('cart', $product);

	// 	$getSession = $this->session->get('cart');

	// 	var_dump($getSession);
	// 	exit();

		// if (in_array($args['id'], 
		// 	array_column($_SESSION['cart'], 'id')) == $args['id']) {
		// 	$search = array_search($args['id'], array_column($_SESSION['cart'], 'id'));

		// 	$_SESSION['cart'][$search]['qty']++;
		// 	$_SESSION['cart'][$search]['price'] += $_SESSION['cart'][$search]['price'];
		// } else {
		// 	$dataCart = $products->getById($args['id']);

		// 	$data = array_merge($dataCart, ['qty' => 1]);

		// 	$_SESSION['cart'][] = $data;
		// }

		// $this->session->set('cart', $dataCart);

	// 	return $response->withRedirect($this->router->pathFor('sale'));
	// }

	// public function deleteByid($request, $response, $args)
	// {
	// 	unset($_SESSION['cart'][$args['id']]);

	// 	return $response->withRedirect($this->router->pathFor('sale'));
	// }

	// public function discard($request, $response)
	// {
	// 	unset($_SESSION['cart']);

	// 	return $response->withRedirect($this->router->pathFor('sale'));
	// }

	// public function pay($request, $response)
	// {
	// 	$pay = new SaleModel($this->db);

	// }

}

?>