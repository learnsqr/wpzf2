<?php

namespace ContractsTest\Controller;

use ContractsTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
<<<<<<< HEAD
use Contracts\Controller\IndexController;
=======
use Contracts\Controller\ContractsController;
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;
<<<<<<< HEAD
use ContractsTest\Model\ContractsTest;
=======
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a


class ContractsControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
<<<<<<< HEAD
        $this->controller = new IndexController();
=======
        $this->controller = new ContractsController();
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'contracts'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }

<<<<<<< HEAD
public function testIndexActionCanBeAccessed(){
=======
public function testIndexActionCanBeAccessed()
	{
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
	    $this->routeMatch->setParam('action', 'index');
	
	    $result   = $this->controller->dispatch($this->request);
	    $response = $this->controller->getResponse();
	
	    $this->assertEquals(200, $response->getStatusCode());
	}
<<<<<<< HEAD
	
	
	
=======
>>>>>>> d884c02b9c1e1b6e2b196c816b2f91079013ed0a
	public function testAddActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'add');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(200, $response->getStatusCode());
	}
	public function testEditActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(200, $response->getStatusCode());
	}
	public function testDeleteActionCanBeAccessed()
	{
		$this->routeMatch->setParam('action', 'index');
	
		$result   = $this->controller->dispatch($this->request);
		$response = $this->controller->getResponse();
	
		$this->assertEquals(200, $response->getStatusCode());
	}
}
?>