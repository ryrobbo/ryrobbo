<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController {

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
        $posts = $this->getService()->get('Post')->getAllPosts();

        $view = new ViewModel(array(
            'posts' => $posts,
            'cleared' => $this->params()->fromQuery('cleared'),
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
            $postId = $this->getService()->get('Post')->createPost($post);

            // redirect to edit page
            return $this->redirect()->toRoute('posts', array(
                        'action' => 'edit',
                        'id' => $postId
                            ), array(
                        'query' => array(
                            'insert' => 'true'
                        )
            ));
        }

        // get form
        $form = new \Admin\Form\PostForm;

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

            if (is_int($this->getService()->get('Post')->updatePost($post))) {
                return $this->redirect()->toRoute('posts', array(
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
        $post = $this->getService()->get('Post')->getPostById($id);

        // get form
        $form = new \Admin\Form\PostForm;
        $form->bind($post);

        // get categories
        $categories = $this->getService()->get('Category')->getAllCategories();
        $categoryform = new \Admin\Form\PostCategoryForm($categories);

        // get post categories
        $postcategories = $this->getService()->get('PostCategory')->getCategoriesByPost($id);

        $view = new ViewModel(array(
            'id' => $id,
            'post' => $post,
            'form' => $form,
            'categoryform' => $categoryform,
            'categories' => $postcategories,
            'updated' => $this->params()->fromQuery('update'),
            'insert' => $this->params()->fromQuery('insert'),
        ));

        return $view;
    }

    public function deleteAction() {
        $id = $this->params()->fromRoute('id');
        $this->getService()->get('Post')->deletePost($id);

        return $this->redirect()->toRoute('posts', array(), array(
                    'query' => array(
                        'deleted' => 'true'
                    )
        ));
    }

    public function cacheAction() {
        // flush the cache
        $this->getService()->get('CacheListener')->getCacheService()->flush();

        return $this->redirect()->toRoute('posts', array(), array(
                    'query' => array(
                        'cleared' => 'true'
                    )
        ));
    }

}
