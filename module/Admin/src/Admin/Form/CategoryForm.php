<?php

namespace Admin\Form;

use Zend\Form\Form;

class CategoryForm extends Form {

    public function __construct() {

        parent::__construct('postform');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/categories/edit');
        $this->setAttribute('id', 'category-form');
        $this->setAttribute('class', 'form');
        
        $this->add(array(
            'name' => 'category',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Name: ',
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
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
    }

}