<?php

namespace App\Models;


abstract class AbstractModel
{
	protected $table;
	protected $column;
	protected $db;
	protected $qb;

    public function __construct($db)
	{
        $this->db = $db;
        $this->qb = $db->createQueryBuilder();
	}

	public function getAllUser()
	{
		$this->qb->select('*')
				 ->from($this->table)
				 ->where('deleted = 0 && status = 1');
		$query = $this->qb->execute();

		return $query->fetchAll();
	}

	public function getAll()
	{
		$this->qb->select('*')
				 ->from($this->table)
				 ->where('deleted = 0');
		$query = $this->qb->execute();

		return $query->fetchAll();
	}

	public function getAllTrash()
	{
		$this->qb->select('*')
				 ->from($this->table)
				 ->where('deleted = 1');
		$query = $this->qb->execute();

		return $query->fetchAll();
	}	

	public function getInactive()
	{
		$this->qb->select('*')
				 ->from($this->table)
				 ->where('deleted = 1');
		$query = $this->qb->execute();
		return $query->fetchAll();
	}

	public function find($column, $value)
	{
		$param = ':'.$column;
		$this->qb
			 ->select('*')
			 ->from($this->table)
			 ->setParameter($param, $value)
			 ->where($column . ' = '. $param);
		$result = $this->qb->execute();
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

		$this->qb->insert($this->table)
				 ->values($valuesColumn)
				 ->setParameters($valuesData)
				 ->execute();
	}

	public function updateData(array $data, $id)
	{
		$valuesColumn = [];
		$valuesData = [];

		$this->qb->update($this->table);

		foreach ($data as $dataKey => $dataValue) {
			$valuesColumn[$dataKey] = ':' . $dataKey;
			$valuesData[$dataKey] = $dataValue;

			$this->qb->set($dataKey, $valuesColumn[$dataKey]);
		}

		$this->qb->setParameters($valuesData)
				 ->where('id = ' . $id)
				 ->execute();
	}

	public function softDelete($id)
	{
		$this->qb->update($this->table)
				 ->set('deleted', 1)
				 ->where('id = ' . $id)
				 ->execute();
	}

	public function restoreData($id)
	{
		$this->qb->update($this->table)
				 ->set('deleted', 0)
				 ->where('id = ' . $id)
				 ->execute();
	}	

	public function hardDelete($id)
	{	
		$this->qb->delete($this->table)
				 ->where('id = ' . $id)
				 ->execute();
	}

	public  function __destruct()
    {
    	$this->db->close();
    }
}

?>
