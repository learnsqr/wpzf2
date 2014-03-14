<?php

namespace ProjectTest\Controller;

use ProjectTest\Bootstrap;
use Zend\Mvc\Router\Http\TreeRouteStack as HttpRouter;
use Project\Controller\IndexController;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\RouteMatch;
use PHPUnit_Framework_TestCase;

class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    protected $controller;
    protected $request;
    protected $response;
    protected $routeMatch;
    protected $event;

    protected function setUp()
    {
        $serviceManager = Bootstrap::getServiceManager();
        $this->controller = new IndexController();
        $this->request    = new Request();
        $this->routeMatch = new RouteMatch(array('controller' => 'index'));
        $this->event      = new MvcEvent();
        $config = $serviceManager->get('Config');
        $routerConfig = isset($config['router']) ? $config['router'] : array();
        $router = HttpRouter::factory($routerConfig);

        $this->event->setRouter($router);
        $this->event->setRouteMatch($this->routeMatch);
        $this->controller->setEvent($this->event);
        $this->controller->setServiceLocator($serviceManager);
    }
    
    public function testIndexActionCanBeAccessed()
    {
    	$this->routeMatch->setParam('action', 'index');
    
    	$result   = $this->controller->dispatch($this->request);
    	$response = $this->controller->getResponse();
    
    	$this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testAddActionCanBeAccessed()
    {
    	$this->routeMatch->setParam('action', 'add');
    
    	$result   = $this->controller->dispatch($this->request);
    	$response = $this->controller->getResponse();
    
    	$this->assertEquals(200, $response->getStatusCode());
    }
    
	public function testEditActionCanBeAccessed()
	{
	    $this->routeMatch->setParam('action', 'edit');
	    $this->routeMatch->setParam('idproject', '1');//Add this Row
	
	    $result   = $this->controller->dispatch($this->request);
	    $response = $this->controller->getResponse();
	
	    $this->assertEquals(200, $response->getStatusCode());
	}
    
    public function testEditActionRedirect()
    {
    	$this->routeMatch->setParam('action', 'edit');
    
    	$result   = $this->controller->dispatch($this->request);
    	$response = $this->controller->getResponse();
    
    	$this->assertEquals(302, $response->getStatusCode());
    }
    
    public function testGetProjectTableReturnsAnInstanceOfProjectTable()
    {
    	$this->assertInstanceOf('Project\Model\ProjectTable', $this->controller->getProjectTable());
    }
    
    public function testDeleteActionCanBeAccessed()
    {
    	$this->routeMatch->setParam('action', 'delete');
    	$this->routeMatch->setParam('idproject', '1');
    
    	$result   = $this->controller->dispatch($this->request);
    	$response = $this->controller->getResponse();
    
    	$this->assertEquals(200, $response->getStatusCode());
    }
    
    public function testDeleteActionRedirect()
    {
    	$this->routeMatch->setParam('action', 'delete');
    
    	$result   = $this->controller->dispatch($this->request);
    	$response = $this->controller->getResponse();
    
    	$this->assertEquals(302, $response->getStatusCode());
    }
}
