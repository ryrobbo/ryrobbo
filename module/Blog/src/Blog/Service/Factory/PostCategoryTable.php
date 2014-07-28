<?php
namespace Blog\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Blog\Model\PostCategory;

class PostCategoryTable implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        // get the tablegatway
        $tableGateway = $serviceLocator->get('PostCategoryTableGateway');
        
        $postTable = new PostCategory($tableGateway);
        return $postTable;
    }

}