<?php
namespace Album\Controller;

use Zend\View\JsonModel\ViewModel;
use Album\Model\Album;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RestController extends AbstractRestfulController
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
	
	/**
	 * Return list of resources
	 *
	 * @return mixed
	 */
	public function getList()
	{
		
		$albums = $this->getAlbumTable()->fetchAll(false);
		$data = array();
		foreach ($albums as $album)
				$data[] = $album;
			
			
		//$this->response->setStatusCode(200);
				
		return  new JsonModel(array(
				'albums' =>$data)
		);
	}
    
}
