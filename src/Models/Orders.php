<?php

namespace App\Models;

class Orders extends AbstractModel 
{
	protected $table = 'orders';

	public function save(array $data) {
		$this->db->insert($this->table, $data);

		return $this->db->lastInsertId();
	}
}
?>
