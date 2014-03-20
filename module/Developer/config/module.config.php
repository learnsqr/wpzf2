<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Developer\Controller\Index' => 'Developer\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'developer' => array(
					'type'    => 'segment',
					'options' => array(
							'route'    => '/developer[/:filename]',							
							'defaults' => array(
									'controller' => 'Developer\Controller\Index',
									'action'     => 'index',
							),
					),
			),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Developer' => __DIR__ . '/../view',
        ),
    ),
	'navigation' => array(
			'default' => include('menu.config.php')
	),
);
