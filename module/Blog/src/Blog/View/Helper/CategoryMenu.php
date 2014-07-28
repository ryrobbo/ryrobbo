<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoryMenu extends AbstractHelper implements ServiceLocatorAwareInterface {

    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator->getServiceLocator();
    }

    public function getServiceLocator() {
        return $this->sm;
    }

    public function __invoke() {
        $categories = $this->getServiceLocator()->get('Category')->getAllCategories();
        
        $html = '';
        
        if($categories->count()) {
            foreach($categories as $category) {
                $html .= '<li><a href="/category/' . $category->slug . '">' . $category->category . '</a></li>';
            }
        } else {
            $html = '<li>No categories</li>';
        }
        return $html;
    }

}
