<?php

namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;
use Cheetara\Model\Cheat;
use Cheetara\Form\cheatForm;


class SearchController extends AbstractActionController
{
	
		
    public function indexAction()
    {
        return new ViewModel();
    }

    
    public function searchCategory()
    {
    	return new ViewModel();
    }
  
    public function searchId()
    {
    	return new ViewModel();
    }
    
    public function search()
    {
    	return new ViewModel();
    }
     
   
}