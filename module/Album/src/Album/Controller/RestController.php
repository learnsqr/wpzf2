<?php
namespace Album\Controller;

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
	 * test with
	 * curl -i -H "Accept: application/json" http://zf2.local/album-rest/1
	 * (non-PHPdoc)
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id) {
		return new JsonModel(array(
				"album" => $this->getAlbumTable()->getAlbum($id)
		));
	}
	
	/**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList() {
    	$albums = $this->getAlbumTable()->fetchAll();
    	$data = array();
    	foreach ($albums as $album)
    		$data[] = $album;

    	return new JsonModel(array(
    			'albums' => $data,
    	));
    }
	
    function create($data) {
    	$album = new Album();
    	$album->exchangeArray($data);
    	$this->getAlbumTable()->saveAlbum($album);
    	return new JsonModel(
    			array("status" => "ok"));
    }
       
    
    public function update($id, $data) 
    {
    	$album = $this->getAlbumTable()->getAlbum($id);
    	foreach ($data as $key => $value) {
    		$album->$key = $value;
    	}
    	$this->getAlbumTable()->saveAlbum($album);
    	return new JsonModel(
    			array("status" => "ok"));
    }
    
    public function delete($id) 
    {
    	$this->getAlbumTable()->deleteAlbum($id);
    	return new JsonModel(
    			array("status" => "ok"));
    }
	
    
}
