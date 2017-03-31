<?php

namespace App\Models;

class ProductModel extends AbstractModel
{
	protected $table = 'product';

	public function where($id)
	{
		if (!empty($id)) {
			$this->qb->select('*')
					 ->from($this->table)
					 ->where('id IN (' . implode(',', $id) . ')');
			$query = $this->qb->execute();
			return $query->fetchAll();
			$query->close();
		}
	}
	
}
