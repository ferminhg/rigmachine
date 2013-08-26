<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Band\Controller\Band' => 'Band\Controller\BandController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'band' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/band[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Band\Controller\Band',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'band' => __DIR__ . '/../view',
        ),
    ),
);