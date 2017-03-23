<?php

namespace App\Models;


abstract class AbstractModel
{
	protected $table;
	protected $db;
	protected $column;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getAll()
	{
		$this->db->select($this->column)
				 ->from($this->table)
				 ->where('deleted = 0');
		$query = $this->db->execute();

		return $query->fetchAll();
	}

	public function find($column, $value)
	{
		$param = ':'.$column;
		$this->db
			 ->select($this->column)
			 ->from($this->table)
			 ->setParameter($param, $value)
			 ->where($column . ' = '. $param);
		$result = $this->db->execute();
		return $result->fetch();
	}

	public function where($column, $value)
	{
		$this->db->select('*')
				 ->from($this->table)
				 ->where($column . ' = ' . $value);
		$result = $this->db->execute();
		return $result->fetch();
	}

	public function createData(array $data)
	{
		$valuesColumn = [];
		$valuesData = [];

		foreach ($data as $dataKey => $dataValue) {
			$valuesColumn[$dataKey] = ':' . $dataKey;
			$valuesData[$dataKey] = $dataValue;
		}

		$this->db->insert($this->table)
				 ->values($valuesColumn)
				 ->setParameters($valuesData)
				 ->execute();
	}

	public function updateData(array $data, $id)
	{
		$valuesColumn = [];
		$valuesData = [];

		$this->db->update($this->table);

		foreach ($data as $dataKey => $dataValue) {
			$valuesColumn[$dataKey] = ':' . $dataKey;
			$valuesData[$dataKey] = $dataValue;

			$this->db->set($dataKey, $valuesColumn[$dataKey]);
		}

		$this->db->setParameters($valuesData)
				 ->where('id = ' . $id)
				 ->execute();
	}

	public function softDelete($id)
	{
		$this->db->update($this->table)
				 ->set('deleted', 1)
				 ->where('id = ' . $id)
				 ->execute();
	}

	public function hardDelete($id)
	{
		$this->db->delete($this->table)
				 ->where('id = ' . $id)
				 ->execute();
	}

}

?>
