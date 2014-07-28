<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Menu extends AbstractHelper implements ServiceLocatorAwareInterface {

    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator->getServiceLocator();
    }

    public function getServiceLocator() {
        return $this->sm;
    }

    public function __invoke() {
        $links = $this->getServiceLocator()->get('Page')->getMainNav();
        
        $html = '';
        
        foreach($links as $link) {
            if($link->id == 1) {
                $html .= '<li><a href="/">' . $link->name . '</a></li>';
            } else {
                $html .= '<li><a href="/page/' . $link->slug . '">' . $link->name . '</a></li>';
            }
        }
        
        return $html;
    }

}
