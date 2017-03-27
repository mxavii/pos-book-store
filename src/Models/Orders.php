<?php

namespace App\Models;

class Orders extends AbstractModel
{
	protected $table = 'orders';

	public function save($user_id, $total_price)
	{
		$stmt = $this->db->prepare("INSERT INTO orders (user_id,total_price) 
			VALUES ($user_id,$total_price)");

		$stmt->execute();

		return $this->db->lastInsertId();
	}
}
?>
