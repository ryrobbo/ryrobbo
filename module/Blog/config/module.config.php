<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            'post' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/post/:slug',
                    'constraints' => array(
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Post',
                        'action' => 'index',
                        'pagecache' => true
                    ),
                ),
            ),
            'page' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/page/:slug',
                    'constraints' => array(
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Page',
                        'action' => 'index',
                    ),
                ),
            ),
            'category' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/category/:slug',
                    'constraints' => array(
                        'slug' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Category',
                        'action' => 'index',
                    ),
                ),
            ),
            '404' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/404',
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Index',
                        'action' => 'notfound',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Post' => 'Blog\Service\Factory\PostTable',
            'PostTableGateway' => 'Blog\Service\Factory\PostTableGateway',
            'PostCategory' => 'Blog\Service\Factory\PostCategoryTable',
            'PostCategoryTableGateway' => 'Blog\Service\Factory\PostCategoryTableGateway',
            'Category' => 'Blog\Service\Factory\CategoryTable',
            'CategoryTableGateway' => 'Blog\Service\Factory\CategoryTableGateway',
            'Page' => 'Blog\Service\Factory\PageTable',
            'PageTableGateway' => 'Blog\Service\Factory\PageTableGateway',
            'CacheListener' => 'Blog\Service\Factory\CacheListenerFactory',
        ),
        'invokables' => array(
            'PostMapper' => 'Blog\Service\Mapper\Post',
            'PostCategoryMapper' => 'Blog\Service\Mapper\PostCategory',
            'CategoryMapper' => 'Blog\Service\Mapper\Category',
            'PageMapper' => 'Blog\Service\Mapper\Page',
        )
    ),
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Index' => 'Blog\Controller\IndexController',
            'Blog\Controller\Post' => 'Blog\Controller\PostController',
            'Blog\Controller\Page' => 'Blog\Controller\PageController',
            'Blog\Controller\Category' => 'Blog\Controller\CategoryController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'blog/index/index' => __DIR__ . '/../view/blog/index/index.phtml',
            'blog/page/index' => __DIR__ . '/../view/blog/page/index.phtml',
            'blog/page/contact' => __DIR__ . '/../view/blog/page/contact.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
            'partial/menu' => __DIR__ . '/../view/partial/menu.phtml',
            'partial/categories' => __DIR__ . '/../view/partial/categories.phtml',
            'partial/recentposts' => __DIR__ . '/../view/partial/recentposts.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => include __DIR__ . '/../template_map.php',
    ),
    'view_helpers' => array(
        'invokables' => array(
            'getCategoryMenu' => 'Blog\View\Helper\CategoryMenu',
            'getPostCategory' => 'Blog\View\Helper\PostCategory',
            'getRecentPosts' => 'Blog\View\Helper\RecentPosts',
            'getMenu' => 'Blog\View\Helper\Menu',
        )
    ),
);
