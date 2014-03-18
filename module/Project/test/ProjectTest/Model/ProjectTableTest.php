<?php
namespace ProjectTest\Model;

use Project\Model\ProjectTable;
use Project\Model\Project;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ProjectTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllProjects()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $projectTable = new ProjectTable($mockTableGateway);

        $this->assertSame($resultSet, $projectTable->fetchAll());
    }
    
    public function testCanRetrieveAnProjectByItsId()
    {
    	$project = new Project();
    	$project->exchangeArray(array('idproject'     => 123,
    			'name' => 'The Military Wives',
    			'description'  => 'In My Dreams',
    			'budget'  => 100));
    
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Project());
    	$resultSet->initialize(array($project));
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
    	->with(array('idproject' => 123))
    	->will($this->returnValue($resultSet));
    
    	$projectTable = new ProjectTable($mockTableGateway);
    
    	$this->assertSame($project, $projectTable->getProject(123));
    }
    
    public function testCanDeleteAProjectByItsId()
    {
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('delete')
    	->with(array('idproject' => 123));
    
    	$projectTable = new ProjectTable($mockTableGateway);
    	$projectTable->deleteProject(123);
    }
    
    public function testSaveProjectWillInsertNewProjectsIfTheyDontAlreadyHaveAnId()
    {
    	$projectData = array('name' => 'The Military Wives', 'description' => 'In My Dreams', 'budget' => '100');
    	$project     = new Project();
    	$project->exchangeArray($projectData);
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('insert')
    	->with($projectData);
    
    	$projectTable = new ProjectTable($mockTableGateway);
    	$projectTable->saveProject($project);
    }
    
    public function testSaveProjectWillUpdateExistingProjectsIfTheyAlreadyHaveAnId()
    {
    	$projectData = array('idproject' => 123, 'name' => 'The Military Wives', 'description' => 'In My Dreams', 'budget' => '100');
    	$project     = new Project();
    	$project->exchangeArray($projectData);
    
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Project());
    	$resultSet->initialize(array($project));
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
    			array('select', 'update'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
    	->with(array('idproject' => 123))
    	->will($this->returnValue($resultSet));
    	$mockTableGateway->expects($this->once())
    	->method('update')
    	->with(array('name' => 'The Military Wives', 'description' => 'In My Dreams', 'budget' => '100'),
    			array('idproject' => 123));
    
    	$projectTable = new ProjectTable($mockTableGateway);
    	$projectTable->saveProject($project);
    }
    
    public function testExceptionIsThrownWhenGettingNonexistentProject()
    {
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Project());
    	$resultSet->initialize(array());
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
    	->with(array('idproject' => 123))
    	->will($this->returnValue($resultSet));
    
    	$projectTable = new ProjectTable($mockTableGateway);
    
    	try
    	{
    		$projectTable->getProject(123);
    	}
    	catch (\Exception $e)
    	{
    		$this->assertSame('Could not find row 123', $e->getMessage());
    		return;
    	}
    
    	$this->fail('Expected exception was not thrown');
    }
    }
