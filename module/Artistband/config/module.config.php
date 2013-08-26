<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Artistband\Controller\Artistband' => 'Artistband\Controller\ArtistbandController',
        ),
    ),

    'router' => array(
        'routes' => array(
            'artistband' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/artistband[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Artistband\Controller\Artistband',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'artistband' => __DIR__ . '/../view',
        ),
    ),
);