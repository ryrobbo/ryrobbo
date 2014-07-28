<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;

class Category {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getCategoryBySlug($slug) {
        $rowset = $this->tableGateway->select(array(
            'slug' => $slug,
            'active' => 1
        ));
        
        $row = $rowset->current();
        
        if(!$row) {
            return false;
        } else {
            return $row;
        }
    }
    
    public function getCategoryById($id) {
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
            'active' => 1
        ));
        
        $row = $rowset->current();
        
        if(!$row) {
            return false;
        } else {
            return $row;
        }
    }
    
    public function getAllCategories() {
        $rowset = $this->tableGateway->select(array(
            'active' => 1
        ));
        
        if(!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }
    
    public function updateCategory($post) {
        return $this->tableGateway->update(array(
                    'category' => $post['category'],
                        ), array(
                    'id' => $post['id']
        ));
    }

    public function createCategory($post) {
        $this->tableGateway->insert(array(
            'category' => $post['category'],
            'slug' => $this->createSlug($post['category']),
            'active' => 1,
        ));

        return $this->tableGateway->getLastInsertValue();
    }
    
    public function deleteCategory($id) {
        $this->tableGateway->update(array(
            'active' => 0
        ), array(
            'id' => $id
        ));
    }
    
    public function createSlug($title) {
        // make the string lowercase
        $title = strtolower($title);

        // array of bad chars
        $badChars = array('@', '!', '£', '$', '"', '\'', '/', '.', '?', '<', '>', ',', '`', '#', '%', '&', '*', '(', ')');

        // replace bad chars with nothing
        $title = str_replace($badChars, '', $title);

        // replace spaces with hyphens
        $title = str_replace(' ', '-', $title);

        // return trimmed string
        return trim($title);
    }

}
