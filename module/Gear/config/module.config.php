<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Gear\Controller\Gear' => 'Gear\Controller\GearController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'gear' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/admin/gear[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Gear\Controller\Gear',
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