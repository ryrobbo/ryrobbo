<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class PostCategoryTableGateway implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // define Db connect and result sets
        $dbAdapter = $serviceLocator->get('DbAdapter');
        
        // get customer mapper
        $mapper = $serviceLocator->get('PostCategoryMapper');
        
        // define resultset and prototype
        $resultSet = new ResultSet;
        $resultSet->setArrayObjectPrototype($mapper);
        
        // create tablegateway
        $tableGateway = new TableGateway('vw_postcategories', $dbAdapter, null, $resultSet);
        
        return $tableGateway;
    }

}