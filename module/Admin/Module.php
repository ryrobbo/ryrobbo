<?php

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // session check for admin routes
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'sessionStart'));
    }

    public function sessionStart(MvcEvent $e) {
        // get route name
        $route = $e->getRouteMatch()->getMatchedRouteName();

        // admin routes
        $adminRoutes = array(
            'posts',
            'pages',
            'categories',
            'postcategory'
        );

        if (in_array($route, $adminRoutes)) {
            $manager = $e->getApplication()->getServiceManager()->get('Session');
            $manager->start();

            Container::setDefaultManager($manager);

            if (!$e->getApplication()->getServiceManager()->get('AdminSession')->isLoggedIn()) {
                $url = $e->getRequest()->getUri();

                header("Location: /admin/login?url=" . urlencode($url));
                exit;
            }
        }
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
