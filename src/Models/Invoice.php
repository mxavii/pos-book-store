<?php

namespace App\Models;

class Invoice extends AbstractModel
{
	protected $table = ['orders', 'users', 'order_items', 'product'];

	public function invoice($no_invoice)
	{
		$this->qb->select('o.no_invoice', 'u.name', 'p.title', 'p.price', 
						  'oi.quantity', 'o.total_paid', 'o.be_paid')
			 ->from($this->table[0], 'o')
			 ->join('o', $this->table[1], 'u', 'u.id = o.user_id')
			 ->join('o', $this->table[2], 'oi', 'o.id = oi.order_id')
			 ->join('oi', $this->table[3], 'p', 'p.id = oi.product_id')
			 ->where('o.no_invoice = ' . $no_invoice);
		$result = $this->qb->execute();

		return $result->fetchAll();
	}
}

?>