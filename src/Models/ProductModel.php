<?php

namespace App\Models;

class ProductModel extends AbstractModel
{
	protected $table = 'product';

	public function where($id)
	{
		if (!empty($id)) {
			$this->db->select('*')
					 ->from($this->table)
					 ->where('id IN (' . implode(',', $id) . ')');
			$query = $this->db->execute();
			return $query->fetchAll();
		}
	}
	
}
