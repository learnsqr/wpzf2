<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Cheetara\Controller\Cheetara' => 'Cheetara\Controller\IndexController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'task' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/cheetara[/:action[/:id]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Cheetara\Controller',
                        'controller'    => 'Cheetara',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'action' => 'add|edit|delete|search',
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
