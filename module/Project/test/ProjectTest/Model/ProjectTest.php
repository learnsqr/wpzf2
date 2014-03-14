<?php
namespace ProjectTest\Model;

use Project\Model\Project;
use PHPUnit_Framework_TestCase;

class ProjectTest extends PHPUnit_Framework_TestCase
{
	public function testProjectInitialState()
	{
		$project = new Project();

		$this->assertNull($project->name, '"name" should initially be null');
		$this->assertNull($project->idproject, '"idproject" should initially be null');
		$this->assertNull($project->description, '"description" should initially be null');
	}

	public function testExchangeArraySetsPropertiesCorrectly()
	{
		$project = new Project();
		$data  = array('name' => 'some artist',
				'idproject'     => 123,
				'description'  => 'some title');

		$project->exchangeArray($data);

		$this->assertSame($data['name'], $project->name, '"name" was not set correctly');
		$this->assertSame($data['idproject'], $project->idproject, '"idproject" was not set correctly');
		$this->assertSame($data['description'], $project->description, '"description" was not set correctly');
	}

	public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent()
	{
		$project = new Project();

		$project->exchangeArray(array('name' => 'some artist',
				'idproject'     => 123,
				'description'  => 'some title'));
		$project->exchangeArray(array());

		$this->assertNull($project->name, '"name" should have defaulted to null');
		$this->assertNull($project->idproject, '"idproject" should have defaulted to null');
		$this->assertNull($project->description, '"description" should have defaulted to null');
	}
}