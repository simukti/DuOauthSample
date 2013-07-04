<?php
return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            )
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\Index'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => realpath(__DIR__ . '/../view')
        ),
    ),
);
