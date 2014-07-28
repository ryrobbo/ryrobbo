<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class IndexController extends AbstractActionController {

    protected $service = null;

    protected function getService() {
        if (is_null($this->service)) {
            $this->service = $this->getServiceLocator();
            return $this->service;
        } else {
            return $this->service;
        }
    }

    public function indexAction() {
        $this->layout('layout/admin');

        $session = new Container('admin');
        $session->offsetSet('name', 'Ryan');
        
        $this->getServiceLocator()->get('Session')->rememberMe(360000);
    }

}
