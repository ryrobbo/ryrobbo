<?php

namespace Admin\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Config\SessionConfig;
use Zend\Session\SessionManager;

class Session implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get session config from sm
        $config = $serviceLocator->get('config');

        // setup config object
        $sConfig = new SessionConfig();
        $sConfig->setOptions($config['session_config']);


        // setup manager and start session
        $sessionManager = new SessionManager($sConfig);

        return $sessionManager;
    }

}
