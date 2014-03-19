<?php

namespace Cheetara\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Cheetara\Model\Category;
use Cheetara\Form\categoryForm;


class CategoryController extends AbstractActionController
{
	
	protected $categoryTable;

	
	public function getCategoryTable()
	{
		if(!$this->categoryTable){
			$sm = $this->getServiceLocator();
			$this->categoryTable = $sm->get('Category\Model\categoryTable');
		}
		return $this->categoryTable;
	}
	
	
    public function indexAction()
    {
        return new ViewModel(array(
    			'categories' => $this->getCategoryTable()->fetchAll(),
    	));
    }

    public function addAction()
    {
    	$form = new categoryForm();
    	$form->get('submit')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$category = new Category();
    		$form->setInputFilter($category->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$category->exchangeArray($form->getData());
    			$this->getCategoryTable()->saveCategory($category);
    	
    			// Redirect to list of categories
    			return $this->redirect()->toRoute('category');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function editAction()
    {
    	$idcategory = (int) $this->params()->fromRoute('id', 0);
    	if (!$idcategory) {
    		return $this->redirect()->toRoute('category', array(
    				'action' => 'add'
    		));
    	}
    	
    	// Get the Category with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$category = $this->getCategoryTable()->getCategory($idcategory);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('category', array(
    				'action' => 'index'
    		));
    	}
    	
    	$form  = new categoryForm();
    	$form->bind($category);
    	$form->get('submit')->setAttribute('value', 'Edit');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($category->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$this->getCategoryTable()->saveCategory($category);
    	
    			// Redirect to list of categories
    			return $this->redirect()->toRoute('category');
    		}
    	}
    	
    	return array(
    			'idcategory' => $idcategory,
    			'form' => $form,
    	);
    }
    
    public function deleteAction()
    {
    	$idcategory = (int) $this->params()->fromRoute('id', 0);
    	if (!$idcategory) {
    		return $this->redirect()->toRoute('category');
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'No');
    	
    		if ($del == 'Yes') {
    			$idcategory = (int) $request->getPost('id');
    			$this->getCategoryTable()->deleteCategory($idcategory);
    		}
    	
    		// Redirect to list of categories
    		return $this->redirect()->toRoute('category');
    	}
    	
    	return array(
    			'idcategory'    => $idcategory,
    			'category' => $this->getCategoryTable()->getCategory($idcategory)
    	);
    }
    
  
    
   
}
