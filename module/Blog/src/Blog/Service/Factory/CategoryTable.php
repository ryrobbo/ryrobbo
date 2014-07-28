<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Blog\Model\Category;

class CategoryTable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get the tablegatway
        $tableGateway = $serviceLocator->get('CategoryTableGateway');
        
        $categoryTable = new Category($tableGateway);
        return $categoryTable;
    }

}