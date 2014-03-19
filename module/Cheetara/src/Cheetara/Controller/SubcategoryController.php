<?php

namespace Subcategory\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Cheetara\Model\Subcategory;
use Cheetara\Form\subcategoryForm;


class SubcategoryController extends AbstractActionController
{
	
	protected $subcategoryTable;

	
	public function getSubcategoryTable()
	{
		if(!$this->subcategoryTable){
			$sm = $this->getServiceLocator();
			$this->subcategoryTable = $sm->get('Subcategory\Model\subcategoryTable');
		}
		return $this->subcategoryTable;
	}
	
	
    public function indexAction()
    {
        return new ViewModel(array(
    			'categories' => $this->getSubcategoryTable()->fetchAll(),
    	));
    }

    public function addAction()
    {
    	$form = new subcategoryForm();
    	$form->get('submit')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$subcategory = new Subcategory();
    		$form->setInputFilter($subcategory->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$subcategory->exchangeArray($form->getData());
    			$this->getSubcategoryTable()->saveSubcategory($subcategory);
    	
    			// Redirect to list of categories
    			return $this->redirect()->toRoute('subcategory');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function editAction()
    {
    	$idsubcategory = (int) $this->params()->fromRoute('id', 0);
    	if (!$idsubcategory) {
    		return $this->redirect()->toRoute('subcategory', array(
    				'action' => 'add'
    		));
    	}
    	
    	// Get the Subcategory with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$subcategory = $this->getSubcategoryTable()->getSubcategory($idsubcategory);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('subcategory', array(
    				'action' => 'index'
    		));
    	}
    	
    	$form  = new subcategoryForm();
    	$form->bind($subcategory);
    	$form->get('submit')->setAttribute('value', 'Edit');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($subcategory->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$this->getSubcategoryTable()->saveSubcategory($subcategory);
    	
    			// Redirect to list of categories
    			return $this->redirect()->toRoute('subcategory');
    		}
    	}
    	
    	return array(
    			'idsubcategory' => $idsubcategory,
    			'form' => $form,
    	);
    }
    
    public function deleteAction()
    {
    	$idsubcategory = (int) $this->params()->fromRoute('id', 0);
    	if (!$idsubcategory) {
    		return $this->redirect()->toRoute('subcategory');
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'No');
    	
    		if ($del == 'Yes') {
    			$idsubcategory = (int) $request->getPost('id');
    			$this->getSubcategoryTable()->deleteSubcategory($idsubcategory);
    		}
    	
    		// Redirect to list of categories
    		return $this->redirect()->toRoute('subcategory');
    	}
    	
    	return array(
    			'idsubcategory'    => $idsubcategory,
    			'subcategory' => $this->getSubcategoryTable()->getSubcategory($idsubcategory)
    	);
    }
    
  
    
   
}