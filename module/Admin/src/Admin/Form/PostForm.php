<?php

namespace Admin\Form;

use Zend\Form\Form;

class PostForm extends Form {

    public function __construct() {

        parent::__construct('postform');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/posts/edit');
        $this->setAttribute('id', 'post-form');
        $this->setAttribute('class', 'form');

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Title: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'title',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'description',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Description: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'description',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'content',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Content: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'content',
                'class' => 'form-control',
            ),
        ));

        
        
        $this->add(array(
            'name' => 'published',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'Published',
                'checked_value' => '1',
                'unchecked_value' => '0',
            )
        ));
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
    }

}