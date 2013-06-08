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
                    'route'    => '/geartype[/][:action][/:id]',
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
            '' => __DIR__ . '/../view', //¿? si pongo geartype no pilla las vistas ?
        ),
    ),
);