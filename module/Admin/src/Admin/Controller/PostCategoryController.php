<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostCategoryController extends AbstractActionController {
    protected $service = null;

    protected function getService() {
        if (is_null($this->service)) {
            $this->service = $this->getServiceLocator();
            return $this->service;
        } else {
            return $this->service;
        }
    }
    
    public function addAction() {
        if($this->getRequest()->isPost()) {
            $post = $this->request->getPost();
            
            if(is_int($this->getService()->get('PostCategory')->insertCategory($post))) {
                $this->redirect()->toRoute('posts', array(
                    'action' => 'edit',
                    'id' => $post['pid']
                ));
            }
        }
    }
    
    public function deleteAction() {
        if($this->getRequest()->isPost()) {
            $post = $this->request->getPost();
            
            if(is_int($this->getService()->get('PostCategory')->deleteCategory($post['id']))) {
                $this->redirect()->toRoute('posts', array(
                    'action' => 'edit',
                    'id' => $post['pid']
                ));
            }
        }
    }
}
