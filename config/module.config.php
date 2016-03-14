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
            'profile' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/profile',
                    'defaults' => array(
                        'controller' => 'CivUser\Controller\User',
                        'action'     => 'profile',
                    ),
                ),
            ),
            'changepassword' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/changepassword',
                    'defaults' => array(
                        'controller' => 'CivUser\Controller\User',
                        'action'     => 'changepassword',
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
    
    // Service config
    'service_manager' => array(
        'invokables' => array(
            'CivUser\User' => 'CivUser\Entity\User',
        ),
        'factories' => array(
            'CivUser\LoginForm'          => 'CivUser\Form\LoginFormFactory',
            'CivUser\ChangepasswordForm' => 'CivUser\Form\ChangepasswordFormFactory',
            'CivUser\AuthService'        => 'CivUser\Service\AuthServiceFactory',
        ),
    ),
);