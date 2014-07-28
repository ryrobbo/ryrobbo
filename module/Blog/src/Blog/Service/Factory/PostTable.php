<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Blog\Model\Post;

class PostTable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get the tablegatway
        $tableGateway = $serviceLocator->get('PostTableGateway');
        
        $postTable = new Post($tableGateway);
        return $postTable;
    }

}