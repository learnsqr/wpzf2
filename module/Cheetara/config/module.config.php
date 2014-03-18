<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cheetara\Controller\Index' => 'Cheetara\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'task' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/cheetara[/:controller[/:action[/:id]]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cheetara\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'controller' => 'category|subcategory|tag|cheat|search',
                        'action' => 'add|edit|delete',
                        'id'     => '[0-9]+',
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
