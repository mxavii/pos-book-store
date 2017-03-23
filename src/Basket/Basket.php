<?php

namespace App\Basket;

use App\Models\ProductModel;
use App\Support\Storage\SessionStorage;

class Basket
{
	protected $storage;
	protected $product;

	public function __construct(SessionStorage $storage, ProductModel $product)
	{
		$this->storage = $storage;
		$this->product = $product;
	}

	public function add($product, $quantity)
	{
		if ($this->has($product)) {
			$quantity = $this->get($product)['quantity'] + $quantity;
		}

		$this->update($product, $quantity);
	}

	public function update($product, $quantity)
	{
		$this->storage->set($product['id'], [
			'product_id'	=>  $product['id'],
			'quantity'		=>  $quantity,
		]);
	}

	public function has($product)
	{
		return $this->storage->exists($product['id']);
	}

	public function get($product)
	{
		return $this->storage->get($product['id']);
	}

	public function remove($product)
	{
		return $this->storage->unset($product['id']);
	}

	public function clear()
	{
		$this->storage->clear();
	}

	public function all()
	{
		$ids = [];
		$item = [];

		foreach ($this->storage->all() as $product) {
			$ids[] = $product['product_id'];
			$quantity[] = $product['quantity'];
		}
		// var_dump($this->storage->all());
		// var_dump($this->product);
		// var_dump($this->storage->get());
		// die();
		if (!empty($ids)) {
			$products = $this->product->getById($ids);
		// var_dump($products);
			foreach ($products as $product) {
				$product['quantity'] = $this->get($product)['quantity'];
				$item[] = $product;
			}
		}

		return $item;
	}

	public function price()
	{
		foreach ($this->all() as $item) {
			$price[] = $item['price'] * $item['quantity'];
		}

		return $price;
	}

	public function subTotal()
	{
		$total = 0;
		
		foreach ($this->all() as $item) {
			$total = $total + $item['price'] * $item['quantity'];
		}

		return $total;
	}
}