<?php


return array(
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin[/:action]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'posts' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/posts[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Post',
                        'action' => 'index',
                        'id' => 0
                    ),
                ),
            ),
            'pages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/pages[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Page',
                        'action' => 'index',
                    ),
                ),
            ),
            'categories' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/categories[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z]*',
                        'id' => '[0-9]*'
                    ),
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Category',
                        'action' => 'index',
                    ),
                ),
            ),
             'postcategory' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin/postcategory[/:action]',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\PostCategory',
                        'action' => 'delete',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Session' => 'Admin\Service\Factory\Session',
            'Login' => 'Admin\Service\Factory\LoginTable',
            'LoginTableGateway' => 'Admin\Service\Factory\LoginTableGateway',
        ),
        'invokables' => array(
            'AdminSession' => 'Admin\Service\Invokable\AdminSession',
            'LoginMapper' => 'Admin\Service\Mapper\Login',
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
            'Admin\Controller\Post' => 'Admin\Controller\PostController',
            'Admin\Controller\Page' => 'Admin\Controller\PageController',
            'Admin\Controller\Category' => 'Admin\Controller\CategoryController',
            'Admin\Controller\PostCategory' => 'Admin\Controller\PostCategoryController',
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => include __DIR__ . '/../template_map.php',
    ),
    'session_config' => array(
        'cookie_httponly' => true,
        'cookie_path' => '/',
        'cookie_secure' => true,
        'use_cookies' => true,
    )
);