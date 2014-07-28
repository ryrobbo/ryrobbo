<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoryController extends AbstractActionController {

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

        // get list of active posts
        $categories = $this->getService()->get('Category')->getAllCategories();

        $view = new ViewModel(array(
            'categories' => $categories,
            'deleted' => $this->params()->fromQuery('deleted'),
        ));

        return $view;
    }

    public function addAction() {
        $this->layout('layout/admin');

        // posted
        if ($this->request->isPost()) {
            $post = $this->getRequest()->getPost();

            // insert post and get its id
            $postId = $this->getService()->get('Category')->createCategory($post);

            // redirect to edit page
            return $this->redirect()->toRoute('categories', array(
                        'action' => 'edit',
                        'id' => $postId
                            ), array(
                        'query' => array(
                            'insert' => 'true'
                        )
            ));
        }

        // get form
        $form = new \Admin\Form\CategoryForm;

        $view = new ViewModel(array(
            'form' => $form,
        ));

        return $view;
    }

    public function editAction() {
        $this->layout('layout/admin');

        // form posted
        if ($this->request->isPost()) {
            $post = $this->getRequest()->getPost();

            if (is_int($this->getService()->get('Category')->updateCategory($post))) {
                return $this->redirect()->toRoute('categories', array(
                            'action' => 'edit',
                            'id' => $post['id']
                                ), array(
                            'query' => array(
                                'update' => 'true'
                            )
                ));
            }
        }

        // not posted
        $id = $this->params()->fromRoute('id');
        $category = $this->getService()->get('Category')->getCategoryById($id);

        // get form
        $form = new \Admin\Form\CategoryForm;
        $form->bind($category);

        $view = new ViewModel(array(
            'id' => $id,
            'category' => $category,
            'form' => $form,
            'updated' => $this->params()->fromQuery('update'),
            'insert' => $this->params()->fromQuery('insert'),
        ));

        return $view;
    }

    public function deleteAction() {
        $id = $this->params()->fromRoute('id');
        $this->getService()->get('Category')->deleteCategory($id);

        return $this->redirect()->toRoute('categories', array(), array(
                    'query' => array(
                        'deleted' => 'true'
                    )
        ));
    }

}
