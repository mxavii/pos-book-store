<?php

namespace App\Models;

class OrderItems extends AbstractModel
{
	protected $table = 'order_items';

	public function saveToMany(array $data)
	{
		$valuesColumn = [];
		$valuesData = [];
	
		$this->qb->insert($this->table);

		foreach ($data as $dataKey => $dataValue) {
			foreach ($dataValue as $key => $value) {
				$valuesColumn[$key] = ':' . $key;
				$valuesData[$key] = $value;
			}

			$this->qb->values($valuesColumn)
				 	 ->setParameters($valuesData)
					 ->execute();
		}
	}
}


?>