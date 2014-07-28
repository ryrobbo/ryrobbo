<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostCategory extends AbstractHelper implements ServiceLocatorAwareInterface {

    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator->getServiceLocator();
    }

    public function getServiceLocator() {
        return $this->sm;
    }

    public function __invoke($id) {
        $categories = $this->getServiceLocator()->get('PostCategory')->getCategoriesByPost($id);
        
        $html = '';
        
        foreach($categories as $category) {
            $html .= '<a href="/category/' . $category->cslug . '">' . $category->category . '</a>, ';
        }
        
        $html = rtrim($html, ', ');
        
        return $html;
    }

}
