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

	public function add(array $data, $images)
	{
		$data = [
			'title' 	 	=> $data['title'],
			'category_id'	=> $data['category_id'],
			'price'      	=> $data['price'],
			'image'   		=> $images,
			'short_desc'  	=> $data['short_desc'],
		];
		$this->createData($data);
	}

	public function update(array $data, $images, $id)
	{
		$data = [
			'title' 	 	=> $data['title'],
			'category_id'	=> $data['category_id'],
			'price'      	=> $data['price'],
			'image'   		=> $images,
			'short_desc'  	=> $data['short_desc'],
		];
		$this->updateData($data, $id);
	}
}
