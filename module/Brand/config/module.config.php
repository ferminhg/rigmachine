<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Brand\Controller\Brand' => 'Brand\Controller\BrandController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'brand' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/brand[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Brand\Controller\Brand',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'geartype' => __DIR__ . '/../view',
        ),
    ),
);