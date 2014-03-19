<?php
namespace Contracts\Form;

use Zend\Form\Form;

class ContractsForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('contracts');

		$this->add(array(
				'name' => 'idcontract',
				'type' => 'Hidden',
		));
		$this->add(array(
				'name' => 'name',
				'type' => 'Text',
				'options' => array(
						'label' => 'Name',
				),
		));
		$this->add(array(
				'name' => 'description',
				'type' => 'Text',
				'options' => array(
						'label' => 'Description',
				),
		));
		$this->add(array(
				'name' => 'date',
				'type' => 'Text',
				'options' => array(
						'label' => 'Date',
				),
		));
		$this->add(array(
				'name' => 'submit',
				'type' => 'Submit',
				'attributes' => array(
						'value' => 'Go',
						'id' => 'submitbutton',
				),
		));
	}
}