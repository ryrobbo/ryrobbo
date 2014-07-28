<?php

namespace Admin\Form;

use Zend\Form\Form;

class PageForm extends Form {

    public function __construct() {

        parent::__construct('pageform');

        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '/admin/pages/edit');
        $this->setAttribute('id', 'post-form');
        $this->setAttribute('class', 'form');

        $this->add(array(
            'name' => 'name',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Name: ',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
            ),
            'attributes' => array(
                'id' => 'name',
                'class' => 'form-control',
            ),
        ));
        
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
            'name' => 'order',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Sort Order: ',
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
            'name' => 'onmenu',
            'type' => 'Zend\Form\Element\Checkbox',
            'options' => array(
                'label' => 'On Menu',
                'checked_value' => '1',
                'unchecked_value' => '0',
            )
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
            'name' => 'template',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Template',
                'label_attributes' => array(
                    'class' => 'control-label'
                ),
                'empty_option' => 'Select a template',
                'value_options' => array(
                    'blog/page/index' => 'Page',
                    'blog/page/Contact' => 'Contact',
                )
            ),
            'attributes' => array(
                'id' => 'template',
                'class' => 'form-control',
            ),
        ));
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
    }

}