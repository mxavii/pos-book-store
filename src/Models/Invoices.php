<?php

namespace App\Models;

class Invoices extends AbstractModel
{
	protected $table = ['orders', 'users', 'order_items', 'product'];

	public function allInvoice()
	{
		$this->qb->select('o.no_invoice', 'o.create_at', 'u.name',
			'o.total_paid', 'o.be_paid')
			 ->from($this->table[0], 'o')
			 ->leftJoin('o', $this->table[1], 'u', 'u.id = o.user_id');
		$result = $this->qb->execute();

		return $result->fetchAll();
	}

	public function getInvoice($no_invoice)
	{
		$this->qb->select('o.no_invoice', 'o.create_at', 'u.name', 'p.title', 
						  'p.price', 'oi.quantity', 'o.total_paid', 
						  'o.be_paid')
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