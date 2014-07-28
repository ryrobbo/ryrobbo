<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PageController extends AbstractActionController {

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
        // get page id
        $slug = $this->params()->fromRoute('slug');

        // get category
        $page = $this->getService()->get('Page')->getPageBySlug($slug);

        // create view model
        $view = new ViewModel();

        // 404 category not found
        if (!$page) {
            $this->redirect()->toRoute('404');
        }
        
        $view->setTemplate($page->template);

        $view->setVariables(array(
            'page' => $page,
        ));

        return $view;
    }

}
