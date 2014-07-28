<?php

namespace Admin\Controller;

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
        $this->layout('layout/admin');

        // get list of active posts
        $pages = $this->getService()->get('Page')->getAllPages();

        $view = new ViewModel(array(
            'pages' => $pages,
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
            $postId = $this->getService()->get('Page')->createPage($post);

            // redirect to edit page
            return $this->redirect()->toRoute('pages', array(
                        'action' => 'edit',
                        'id' => $postId
                            ), array(
                        'query' => array(
                            'insert' => 'true'
                        )
            ));
        }

        // get form
        $form = new \Admin\Form\PageForm;

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

            if (is_int($this->getService()->get('Page')->updatePage($post))) {
                return $this->redirect()->toRoute('pages', array(
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
        $page = $this->getService()->get('Page')->getPageById($id);

        // get form
        $form = new \Admin\Form\PageForm;
        $form->bind($page);

        $view = new ViewModel(array(
            'id' => $id,
            'post' => $page,
            'form' => $form,
            'updated' => $this->params()->fromQuery('update'),
            'insert' => $this->params()->fromQuery('insert'),
        ));

        return $view;
    }

    public function deleteAction() {
        $id = $this->params()->fromRoute('id');
        $this->getService()->get('Page')->deletePage($id);

        return $this->redirect()->toRoute('pages', array(), array(
                    'query' => array(
                        'deleted' => 'true'
                    )
        ));
    }
}
