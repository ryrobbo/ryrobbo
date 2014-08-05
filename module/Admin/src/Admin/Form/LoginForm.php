<?php

namespace Admin\Form;

use Zend\Form\Form;

class LoginForm extends Form {

    public function __construct() {

        parent::__construct('loginform');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/loginprocess');
        $this->setAttribute('id', 'login-form');
        $this->setAttribute('class', 'form');
        
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Email: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'category',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'pwd',
            'type' => 'Zend\Form\Element\Password',
            'options' => array(
                'label' => 'Password: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'category',
                'class' => 'form-control',
            ),
        ));
    }

}