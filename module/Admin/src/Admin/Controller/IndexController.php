<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        if (!$this->getServiceLocator()->get('AdminSession')->isLoggedIn()) {
            return $this->redirect()->toRoute('admin', array(
                        'action' => 'login'
            ));
        }

        $this->layout('layout/admin');
    }

    public function loginAction() {
        $this->layout('layout/login');

        $form = new \Admin\Form\LoginForm();

        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function loginprocessAction() {
        $this->layout('layout/login');

        if ($this->getRequest()->isPost()) {
            $post = $this->getRequest()->getPost();

            // validate post input
            $form = new \Admin\Form\LoginForm();
            $form->setInputFilter(new \Admin\Form\LoginFilter());
            $form->bind($post);

            // entered data is ok
            if ($form->isValid()) {
                // load user object
                $user = $this->getServiceLocator()->get('LoginMapper');
                $user->exchangeArray($post);

                // check if it's in the db.
                $login = $this->getServiceLocator()->get('Login')->getValidLogin($user);

                if ($login) {
                    // set session
                    $this->getServiceLocator()->get('AdminSession')->setLoggedIn($login);
                    $this->getServiceLocator()->get('AdminSession')->getDefaultManager()->rememberMe(2400000);

                    // redirect to main account page
                    return $this->redirect()->toRoute('admin', array(
                                'action' => 'index'
                    ));
                } else {
                    $view = new ViewModel(array(
                        'form' => $form,
                        'invalid' => true
                    ));

                    $view->setTemplate('admin/index/login');

                    return $view;
                }
            } else {
                $view = new ViewModel(array(
                    'form' => $form,
                ));

                $view->setTemplate('admin/index/login');

                return $view;
            }
        } else {
            return $this->redirect()->toRoute('admin', array(
                        'action' => 'login'
            ));
        }
    }

    public function logoutAction() {
        $this->getServiceLocator()->get('Session')->expireSessionCookie();

        return $this->redirect()->toRoute('admin', array(
                    'action' => 'login'
        ));
    }

}
