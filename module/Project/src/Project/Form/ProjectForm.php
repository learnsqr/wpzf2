<?php
namespace Project\Form;

use Zend\Form\Form;

class ProjectForm extends Form
{
	public function __construct($name = null)
	{
		// we want to ignore the name passed
		parent::__construct('project');

		$this->add(array(
				'name' => 'idproject',
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
				'name' => 'budget',
				'type' => 'Text',
				'options' => array(
						'label' => 'Budget',
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
