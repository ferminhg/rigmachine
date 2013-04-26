<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Geartype\Controller\Geartype' => 'Geartype\Controller\GeartypeController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'geartype' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/geartype[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Geartype\Controller\Geartype',
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