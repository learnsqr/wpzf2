<?php
namespace Contracts;

use Contracts\Model\Contracts;
use Contracts\Model\ContractsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Contracts\Model\ContractsTable' =>  function($sm) {
    						$tableGateway = $sm->get('ContractsTableGateway');
    						$table = new ContractsTable($tableGateway);
    						return $table;
    					},
    					'ContractsTableGateway' => function ($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Contracts());
    						return new TableGateway('contracts', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    	);
    }
}
