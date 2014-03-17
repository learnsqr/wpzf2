<?php
return array(
    
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
					'album' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/album[/][:action][/:id]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'id'     => '[0-9]+',
									),
									'defaults' => array(
											'controller' => 'Album\Controller\Index',
											'action'     => 'index',
									),
							),
					),
					
			),
			
	),
   
    
	'controllers' => array(
			'invokables' => array(
					'Album\Controller\Index' 		=> 'Album\Controller\IndexController',
					
			),
	),
    'view_manager' => array(
        'template_map' => array(
        	//'layout/layout'           => __DIR__ . '/../view/layout/backend.phtml',
            //'album/index/index' => __DIR__ . '/../view/album/index/index.phtml',            
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
		
	'navigation' => array(
			'default' => include('menu.config.php')
	),
);

