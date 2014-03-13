<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	protected $albumTable;
	
	public function getAlbumTable()
	{
		if (!$this->albumTable) {
			$sm = $this->getServiceLocator();
			$this->albumTable = $sm->get('Album\Model\AlbumTable');
		}
		return $this->albumTable;
	}
	
	public function indexAction()
    {
    	return new ViewModel(array(
    			'albums' => $this->getAlbumTable()->fetchAll(),
    	));
    }
    
    public function addAction()
    {
    	return new ViewModel();
    }
    
    public function editAction()
    {
    	return new ViewModel();
    }
    
    public function deleteAction()
    {
    	return new ViewModel();
    }
    
}
