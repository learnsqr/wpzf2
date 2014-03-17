<?php
namespace Contracts\Model;

use Zend\Db\TableGateway\TableGateway;

class ContractsTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getContracts($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('idcontract' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveContracts(Contracts $contract)
	{
		$data = array(
				'name' 		=> $contract->name,
				'description'   => $contract->description,
				'date'  	=> $contract->date,
		);

		$id = (int) $contract->idcontract;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getContracts($id)) {
				$this->tableGateway->update($data, array('idcontract' => $id));
			} else {
				throw new \Exception('Contract id does not exist');
			}
		}
	}

	public function deleteContracts($id)
	{
		$this->tableGateway->delete(array('idcontract' => (int) $id));
	}
}