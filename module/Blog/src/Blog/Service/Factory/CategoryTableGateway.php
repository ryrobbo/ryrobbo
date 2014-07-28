<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class CategoryTableGateway implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // define Db connect and result sets
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        // get customer mapper
        $mapper = $serviceLocator->get('CategoryMapper');
        
        // define resultset and prototype
        $resultSet = new ResultSet;
        $resultSet->setArrayObjectPrototype($mapper);
        
        // create tablegateway
        $tableGateway = new TableGateway('categories', $dbAdapter, null, $resultSet);
        
        return $tableGateway;
    }

}