<?php
namespace ContractsTest\Model;

use Contracts\Model\ContractsTable;
use Contracts\Model\Contracts;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class ContractsTableTest extends PHPUnit_Framework_TestCase
{
    public function testFetchAllReturnsAllContracts()
    {
        $resultSet        = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
                                           array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                         ->method('select')
                         ->with()
                         ->will($this->returnValue($resultSet));

        $contractTable = new ContractsTable($mockTableGateway);

        $this->assertSame($resultSet, $contractTable->fetchAll());
    }
    
    public function testCanRetrieveAContractByItsId()
    {
    	$contract = new Contracts();
<<<<<<< HEAD
    	$contract->exchangeArray(array( 'idcontract'  => 123,
						    			'name'        => 'The Military Wives',
						    			'description' => 'In My Dreams',
						                'date'        => '00/00/0000'));
						    
=======
    	$contract->exchangeArray(array('idcontract'     => 123,
    			'name'        => 'The Military Wives',
    			'description' => 'In My Dreams',
                        'date'        => '00/00/0000'));
    
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Contracts());
    	$resultSet->initialize(array($contract));
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
<<<<<<< HEAD
    	->with(array('idcontract' => 123))
=======
    	->with(array('id' => 123))
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
    	->will($this->returnValue($resultSet));
    
    	$contractTable = new ContractsTable($mockTableGateway);
    
    	$this->assertSame($contract, $contractTable->getContracts(123));
    }
    
    public function testCanDeleteAContractByItsId()
    {
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('delete')
    	->with(array('idcontract' => 123));
    
    	$contractTable = new ContractsTable($mockTableGateway);
    	$contractTable->deleteContracts(123);
    }
    
    public function testSaveContractWillInsertNewContractsIfTheyDontAlreadyHaveAnId()
    {
    	$contractData = array('name' => 'Contract1', 'description' => 'New Contract', 'date' => '00/00/0000');
    	$contract     = new Contracts();
    	$contract->exchangeArray($contractData);
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('insert')
    	->with($contractData);
    
    	$contractTable = new ContractsTable($mockTableGateway);
    	$contractTable->saveContracts($contract);
    }
    
    public function testSaveContractWillUpdateExistingContractsIfTheyAlreadyHaveAnId()
    {
<<<<<<< HEAD
    	$contractData = array('idcontract' => 123, 'name' => 'Contract 1', 'description' => 'Contract 1 Description', 'date' => '00/00/0000');
    	$contract     = new Contracts();
    	$contract->exchangeArray($contractData);
=======
    	$contractData = array('id' => 123, 'artist' => 'The Military Wives', 'title' => 'In My Dreams');
    	$contract     = new Contrats();
    	$contract>exchangeArray($contractData);
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
    
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Contracts());
    	$resultSet->initialize(array($contract));
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway',
    			array('select', 'update'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
<<<<<<< HEAD
    	->with(array('idcontract' => 123))
    	->will($this->returnValue($resultSet));
    	$mockTableGateway->expects($this->once())
    	->method('update')
    	->with(array('name' => 'Contract 1', 'description' => 'Contract 1 Description', 'date' => '00/00/0000'),
    			array('idcontract' => 123));
    
    	$contractTable = new ContractsTable($mockTableGateway);
=======
    	->with(array('id' => 123))
    	->will($this->returnValue($resultSet));
    	$mockTableGateway->expects($this->once())
    	->method('update')
    	->with(array('artist' => 'The Military Wives', 'title' => 'In My Dreams'),
    			array('id' => 123));
    
    	$contractTable = new $ContractsTable($mockTableGateway);
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
    	$contractTable->saveContracts($contract);
    }
    
    public function testExceptionIsThrownWhenGettingNonexistentContracts()
    {
    	$resultSet = new ResultSet();
    	$resultSet->setArrayObjectPrototype(new Contracts());
    	$resultSet->initialize(array());
    
    	$mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
    	$mockTableGateway->expects($this->once())
    	->method('select')
    	->with(array('idcontract' => 123))
    	->will($this->returnValue($resultSet));
    
    	$contractTable = new ContractsTable($mockTableGateway);
    
    	try
    	{
    		$contractTable->getContracts(123);
    	}
    	catch (\Exception $e)
    	{
    		$this->assertSame('Could not find row 123', $e->getMessage());
    		return;
    	}
    
    	$this->fail('Expected exception was not thrown');
    }
}