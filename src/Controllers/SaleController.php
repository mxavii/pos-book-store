<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\Orders;
use App\Models\OrderItems;

class SaleController extends AbstractController
{
	public function index($requests, $response)
	{
		$sale = new ProductModel($this->db);

		$products = $sale->getAll();

		return $this->view->render($response, 'sale/index.twig', [
			'products' => $products
		]);
	}

	public function add($request, $response, $args)
	{
		$product = new ProductModel($this->db);

		$products = $product->find('id', $args['id']);
		
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

	public function pay($request, $response)
	{	
		$order = new Orders($this->db);
		$orderItems = new OrderItems($this->db);

		// Insert Table Orders ---------------------------------
		$user_id = $_SESSION['user']['id'];
		$total_price = $this->basket->total();

		$orderId = $order->save($user_id, $total_price);

		// Insert Table OrderItems -----------------------------
		foreach ($this->basket->all() as $item) {
 			$data[] = [
 				'order_id'		=>	$orderId,
 				'product_id'  	=> 	$item['id'], 
 				'quantity'	  	=> 	$item['quantity'],
 			];
 		}

 		$orderItems->saveToMany($data);

		return $response->withRedirect($this->router->pathFor('sale'));
	}
}
?>