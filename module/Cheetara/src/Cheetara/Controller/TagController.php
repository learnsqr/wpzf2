<?php

namespace Tag\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Cheetara\Model\Tag;
use Cheetara\Form\tagForm;


class TagController extends AbstractActionController
{
	
	protected $tagTable;

	
	public function getTagTable()
	{
		if(!$this->tagTable){
			$sm = $this->getServiceLocator();
			$this->tagTable = $sm->get('Tag\Model\tagTable');
		}
		return $this->tagTable;
	}
	
	
    public function indexAction()
    {
        return new ViewModel(array(
    			'tags' => $this->getTagTable()->fetchAll(),
    	));
    }

    public function addAction()
    {
    	$form = new tagForm();
    	$form->get('submit')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$tag = new Tag();
    		$form->setInputFilter($tag->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$tag->exchangeArray($form->getData());
    			$this->getTagTable()->saveTag($tag);
    	
    			// Redirect to list of tags
    			return $this->redirect()->toRoute('tag');
    		}
    	}
    	return array('form' => $form);
    }
    
    public function editAction()
    {
    	$idtag = (int) $this->params()->fromRoute('id', 0);
    	if (!$idtag) {
    		return $this->redirect()->toRoute('tag', array(
    				'action' => 'add'
    		));
    	}
    	
    	// Get the Tag with the specified id.  An exception is thrown
    	// if it cannot be found, in which case go to the index page.
    	try {
    		$tag = $this->getTagTable()->getTag($idtag);
    	}
    	catch (\Exception $ex) {
    		return $this->redirect()->toRoute('tag', array(
    				'action' => 'index'
    		));
    	}
    	
    	$form  = new tagForm();
    	$form->bind($tag);
    	$form->get('submit')->setAttribute('value', 'Edit');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$form->setInputFilter($tag->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$this->getTagTable()->saveTag($tag);
    	
    			// Redirect to list of tags
    			return $this->redirect()->toRoute('tag');
    		}
    	}
    	
    	return array(
    			'idtag' => $idtag,
    			'form' => $form,
    	);
    }
    
    public function deleteAction()
    {
    	$idtag = (int) $this->params()->fromRoute('id', 0);
    	if (!$idtag) {
    		return $this->redirect()->toRoute('tag');
    	}
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$del = $request->getPost('del', 'No');
    	
    		if ($del == 'Yes') {
    			$idtag = (int) $request->getPost('id');
    			$this->getTagTable()->deleteTag($idtag);
    		}
    	
    		// Redirect to list of tags
    		return $this->redirect()->toRoute('cheetara');
    	}
    	
    	return array(
    			'idtag'    => $idtag,
    			'tag' => $this->getTagTable()->getTag($idtag)
    	);
    }
    
  
    
   
}
