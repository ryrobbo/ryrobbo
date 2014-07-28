<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Blog\Model\CacheListener;

class CacheListenerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new CacheListener($serviceLocator->get('Zend\Cache'));
    }

}