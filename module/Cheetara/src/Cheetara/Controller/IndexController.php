<?php

namespace Cheetara\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Cheetara\Model\Cheat;
use Cheetara\Form\cheatForm;


class IndexController extends AbstractActionController
{
	
	protected $cheatTable;

	
	public function getCheatTable()
	{
		if(!$this->cheatTable){
			$sm = $this->getServiceLocator();
			$this->cheatTable = $sm->get('Cheat\Model\cheatTable');
		}
		return $this->cheatTable;
	}
	
	
    public function indexAction()
    {
        return new ViewModel(array(
    			'categories' => $this->getCheatTable()->fetchAll(),
    	));
    }

    public function addAction()
    {
    	$form = new cheatForm();
    	$form->get('submit')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$cheat = new Cheat();
    		$form->setInputFilter($cheat->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$cheat->exchangeArray($form->getData());
    			$this->getCheatTable()->saveCheat($cheat);
    	
    			// Redirect to list of cheats
    			return $this->redirect()->toRoute('cheetara');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function editAction()
    {
    	$idcheat = (int) $this->params()->fromRoute('id', 0);
    	if (!$idcheat) {
    		return $this->redirect()->toRoute('cheetara', array(
    				'action' => 'add'
    		));
    	}
    	
    	// Get the Cheat with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$cheat = $this->getCheatTable()->getCheat($idcheat);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('cheetara', array(
    				'action' => 'index'
    		));
    	}
    	
    	$form  = new cheatForm();
    	$form->bind($cheat);
    	$form->get('submit')->setAttribute('value', 'Edit');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($cheat->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$this->getCheatTable()->saveCheat($cheat);
    	
    			// Redirect to list of cheats
    			return $this->redirect()->toRoute('cheetara');
    		}
    	}
    	
    	return array(
    			'idcheat' => $idcheat,
    			'form' => $form,
    	);
    }
    
    public function deleteAction()
    {
    	$idcheat = (int) $this->params()->fromRoute('id', 0);
    	if (!$idcheat) {
    		return $this->redirect()->toRoute('cheetara');
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'No');
    	
    		if ($del == 'Yes') {
    			$idcheat = (int) $request->getPost('id');
    			$this->getCheatTable()->deleteCheat($idcheat);
    		}
    	
    		// Redirect to list of cheats
    		return $this->redirect()->toRoute('cheetara');
    	}
    	
    	return array(
    			'idcheat'    => $idcheat,
    			'cheat' => $this->getCheatTable()->getCheat($idcheat)
    	);
    }
    
  
    
   
}
