<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Blog\Model\Page;

class PageTable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get the tablegatway
        $tableGateway = $serviceLocator->get('PageTableGateway');
        
        $pageTable = new Page($tableGateway);
        return $pageTable;
    }

}