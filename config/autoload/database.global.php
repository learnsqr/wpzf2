<?php
/**
 * Local Database Configuration Override
 *
 * You can use this file for overriding database configuration values from modules, etc.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
		'service_manager' => array(
				// for primary db adapter that called
				// by $sm->get('Zend\Db\Adapter\Adapter')
				'factories' => array(
						'Zend\Db\Adapter\Adapter'=> 'Zend\Db\Adapter\AdapterServiceFactory',						
				),
				// to allow other adapter to be called by
				// $sm->get('db1') or $sm->get('db2') based on the adapters config.
				'abstract_factories' => array(
						'Zend\Db\Adapter\AdapterAbstractServiceFactory',
				),
		),
);