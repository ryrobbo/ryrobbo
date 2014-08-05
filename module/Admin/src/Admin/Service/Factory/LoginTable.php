<?php
namespace Admin\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Admin\Model\Login;

class LoginTable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get the tablegatway
        $tableGateway = $serviceLocator->get('LoginTableGateway');
        
        $loginTable = new Login($tableGateway);
        return $loginTable;
    }

}