<?php

namespace CivUser;

return array(
    
    // Router config.
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/login',
                    'defaults' => array(
                        'controller' => 'CivUser\Controller\User',
                        'action'     => 'login',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/logout',
                    'defaults' => array(
                        'controller' => 'CivUser\Controller\User',
                        'action'     => 'logout',
                    ),
                ),
            ),
        ),
    ),
    
    // Controller config.
    'controllers' => array(
        'invokables' => array(
            'CivUser\Controller\User' => 'CivUser\Controller\UserController',
        ),
    ),
    
    // View config.
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);