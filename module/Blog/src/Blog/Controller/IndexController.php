<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

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
        // get category
        $page = $this->getService()->get('Page')->getPageBySlug('index');

        // create view model
        $view = new ViewModel();

        // 404 category not found
        if (!$page) {
            $this->redirect()->toRoute('404');
        }

        $view->setVariables(array(
            'page' => $page,
        ));

        return $view;
    }

    public function notfoundAction() {
        // create view model
        $view = new ViewModel();
        $view->setTemplate('error/404');
        $view->setVariable('message', 'Page not found.');
        return $view;
    }

}
