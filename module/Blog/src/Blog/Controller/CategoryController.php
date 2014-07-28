<?php

namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController
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
        // get category id
        $slug = $this->params()->fromRoute('slug');
        
        // get category
        $category = $this->getService()->get('Category')->getCategoryBySlug($slug);
        
        // create view model
        $view = new ViewModel();
        
        // 404 category not found
        if(!$category) {
            $this->redirect()->toRoute('404');
        }
        
        // get posts from that category
        $posts = $this->getService()->get('PostCategory')->getPostsByCategory($category->id);
        
        $view->setVariables(array(
            'posts' => $posts,
            'category' => $category
        ));
                
        return $view;
    }
}
