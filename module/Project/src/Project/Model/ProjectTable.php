<?php
namespace Project\Model;

use Zend\Db\TableGateway\TableGateway;

class ProjectTable
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

	public function getProject($idproject)
	{
		$idproject  = (int) $idproject;
		$rowset = $this->tableGateway->select(array('idproject' => $idproject));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $idproject");
		}
		return $row;
	}

	public function saveProject(Project $project)
	{
		$data = array(
				'name' => $project->name,
				'description'  => $project->description,
				'budget'  => $project->budget,
		);

		$idproject = (int) $project->idproject;
		if ($idproject == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getProject($idproject)) {
				$this->tableGateway->update($data, array('idproject' => $idproject));
			} else {
				throw new \Exception('Project id does not exist');
			}
		}
	}

	public function deleteProject($idproject)
	{
		$this->tableGateway->delete(array('idproject' => (int) $idproject));
	}
   }