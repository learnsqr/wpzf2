<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cheetara\Controller\Index' => 'Cheetara\Controller\IndexController',
        		'Cheetara\Controller\Category' => 'Cheetara\Controller\CategoryController',
        		'Cheetara\Controller\Cheat' => 'Cheetara\Controller\CheatController',
        		'Cheetara\Controller\Tag' => 'Cheetara\Controller\TagController'
        ),
    ),
		
	'router' => array(
			'routes' => array(
					'cheetara' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/cheetara[/:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Cheetara\Index',
											'action'     => 'index',
									),
							),
							'may_terminate' => true,
							'child_routes' => array(
									'Category' => array(
											'type' => 'Segment',
											'options' => array(
													'route' => '/[:controller[/:action]]',
													'constraints' => array(
															'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
															'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
													),
													'defaults' => array(
													),
											),
									),
									'Cheat' => array(
											'type' => 'Segment',
											'options' => array(
													'route' => '/[:controller[/:action]]',
													'constraints' => array(
															'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
															'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
													),
													'defaults' => array(
													),
											),
									),
									'Tag' => array(
											'type' => 'Segment',
											'options' => array(
													'route' => '/[:controller[/:action]]',
													'constraints' => array(
															'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
															'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
													),
													'defaults' => array(
													),
											),
									),
							),
					),
	
			),
	),
    
    'view_manager' => array(
        'template_path_stack' => array(
            'Cheetara' => __DIR__ . '/../view',
        ),
    ),
);
