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
		$this->basket->remove($args);
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
		$this->validation
			 ->rule('required', ['be_paid'])
			 ->rule('numeric', ['be_paid'])
			 ->message("INPUT MUST NUMBER");
		if ($this->validation->validate()) {
			$no_invoice = date('ym') . '000000';
			
			$no_inv = $order->desc('no_invoice');
			if (!empty($no_inv)) {
				$no_invoice = $no_inv['no_invoice'];
				$no_invoice++;
			}
			// Insert Table Orders ---------------------------------
			$dataOrder = [
				'no_invoice'	=>	(int) $no_invoice,
				'user_id'		=>	$_SESSION['user']['id'],
				'total_paid'	=>	$this->basket->total(),
				'be_paid'		=>	(int) $request->getParam('be_paid'),
			];
			$orderId = $order->save($dataOrder);
			// Insert Table OrderItems -----------------------------
			foreach ($this->basket->all() as $item) {
	 			$data[] = [
	 				'order_id'		=>	$orderId,
	 				'product_id'  	=> 	$item['id'], 
	 				'quantity'	  	=> 	$item['quantity'],
	 			];
	 		}
	 		$orderItems->saveToMany($data);
	 		$this->basket->clear();
			return $response->withRedirect($this->router->pathFor('noInvoice',
				['no_invoice' => $no_invoice]));
		} else {
			$_SESSION['errors'] = $this->validation->errors();
			return $response->withRedirect($this->router->pathFor('sale'));
		}
	}
}
?>
