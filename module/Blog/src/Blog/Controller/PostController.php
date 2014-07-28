<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    protected $service = null;
    
    protected function getService() {
        if(is_null($this->service)) {
            $this->service = $this->getServiceLocator();
            return $this->service;
        } else {
            return $this->service;
        }
    }
    
    public function indexAction()
    {
        // get post id
        $slug = $this->params()->fromRoute('slug');
        
        // get post
        $post = $this->getService()->get('Post')->getPostBySlug($slug);
        
        // create view model
        $view = new ViewModel();
        
        // 404 post not found
        if(!$post) {
            $this->redirect()->toRoute('404');
        }
        
        $view->setVariables(array(
            'post' => $post
        ));
                
        return $view;
    }
}
