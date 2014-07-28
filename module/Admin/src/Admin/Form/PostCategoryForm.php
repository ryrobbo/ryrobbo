<?php

namespace Admin\Form;

use Zend\Form\Form;

class PostCategoryForm extends Form {

    public function __construct($categories) {

        parent::__construct('postform');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/postcategory/add');
        $this->setAttribute('id', 'category-form');
        $this->setAttribute('class', 'form-inline');
        
        $list = array();
        
        foreach($categories as $category) {
            $list[$category->id] = $category->category;
        }
        

        $this->add(array(
            'name' => 'cid',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Title: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
                'value_options' => $list
            ),
            'attributes' => array(
                'id' => 'title',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'pid',
            'type' => 'Zend\Form\Element\Hidden',
        ));
    }

}