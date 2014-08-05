<?php
namespace Admin\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class LoginTableGateway implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // define Db connect and result sets
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        // get customer mapper
        $mapper = $serviceLocator->get('LoginMapper');
        
        // define resultset and prototype
        $resultSet = new ResultSet;
        $resultSet->setArrayObjectPrototype($mapper);
        
        // create tablegateway
        $tableGateway = new TableGateway('login', $dbAdapter, null, $resultSet);
        
        return $tableGateway;
    }

}