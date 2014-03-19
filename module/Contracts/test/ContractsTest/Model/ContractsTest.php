<?php
namespace ContractsTest\Model;

use Contracts\Model\Contracts;
use PHPUnit_Framework_TestCase;

class ContractsTest extends PHPUnit_Framework_TestCase
{
	public function testContratsInitialState()
	{
		$contract = new Contracts();

		$this->assertNull($contract->name, '"name" should initially be null');
		$this->assertNull($contract->idcontract, '"idcontract" should initially be null');
		$this->assertNull($contract->description, '"description" should initially be null');
                $this->assertNull($contract->date, '"date" should initially be null');
	}

	public function testExchangeArraySetsPropertiesCorrectly()
	{
		$contract = new Contracts();
		$data  = array( 'name' 		=> '',
				'idcontract'    => 123,
				'description'  	=> 'some description',
                                'date'  	=> 'date');

		$contract->exchangeArray($data);

		$this->assertSame($data['name'], $contract->name, '"name" was not set correctly');
		$this->assertSame($data['idcontract'], $contract->idcontract, '"idcontract" was not set correctly');
		$this->assertSame($data['description'], $contract->description, '"title" was not set correctly');
                $this->assertSame($data['date'], $contract->date, '"date" was not set correctly');
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
	{
		$contract = new Contracts();

		$contract->exchangeArray(array('name' => 'some artist',
				'idcontract'     => 123,
				'description'    => 'some title',
                                'date'           => 'DATE'));
		$contract->exchangeArray(array());

		$this->assertNull($contract->name,	 '"name" should have defaulted to null');
		$this->assertNull($contract->idcontract, '"idcontract" should have defaulted to null');
		$this->assertNull($contract->description,'"description" should have defaulted to null');
                $this->assertNull($contract->date, 	 '"date" should have defaulted to null');

	}
	}
