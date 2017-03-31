<?php

namespace App\Basket;

use App\Core\Storage\SessionStorage;
use App\Models\ProductModel;

class Basket {
	protected $storage;
	protected $product;

	public function __construct(SessionStorage $storage, ProductModel $product) {
		$this->storage = $storage;
		$this->product = $product;
	}

	public function add($product, $quantity) {
		if ($this->has($product)) {
			$quantity = $this->get($product)['quantity'] + $quantity;
		}

		$this->update($product, $quantity);
	}

	public function update($product, $quantity) {
		$this->storage->set($product['id'], [
			'product_id' => (int) $product['id'],
			'quantity' => (int) $quantity,
		]);
	}

	public function has($product) {
		return $this->storage->exists($product['id']);
	}

	public function get($product) {
		return $this->storage->get($product['id']);
	}

	public function remove($product) {
		return $this->storage->unset($product['id']);
	}

	public function clear() {
		$this->storage->clear();
	}

	public function all() {
		$ids = [];
		$item = [];

		foreach ($this->storage->all() as $product) {
			$ids[] = $product['product_id'];
		}

		if (!empty($ids)) {
			$products = $this->product->where($ids);

			foreach ($products as $product) {
				$product['quantity'] = $this->get($product)['quantity'];
				$item[] = $product;
			}
		}

		return $item;
	}

	public function subTotal() {
		$subTotal = 0;

		foreach ($this->all() as $item) {
			$subTotal = $subTotal + $item['price'] * $item['quantity'];
		}

		return $subTotal;
	}

	public function total() {
		$total = 0;

		if (!empty($this->subTotal())) {

			$tax = '';

			$totalTax = $tax * $this->subTotal();

			$total = $this->subTotal() - $totalTax;
		}

		return $total;
	}
}