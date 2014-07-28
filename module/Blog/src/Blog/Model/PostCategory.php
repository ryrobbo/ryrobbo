<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Update;

class PostCategory {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getPostsByCategory($cid) {
        $rowset = $this->tableGateway->select(array(
            'cid' => $cid,
            'pactive' => 1,
            'published' => 1,
            'active' => 1
        ));
        
        if(!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }
    
    public function getCategoriesByPost($id) {
        $rowset = $this->tableGateway->select(array(
            'pid' => $id,
            'active' => 1
        ));
        
        if(!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }
    
    public function insertCategory($post) {        
        return $this->tableGateway->insert(array(
            'pid' => $post['pid'],
            'cid' => $post['cid'],
            'active' => 1
        ));
    }
    
    public function deleteCategory($id) {
        $update = new Update('vw_postcategories');
        
        $update->set(array(
            'active' => 0
        ));
        $update->where(array(
            'id' => $id
        ));
        
        return $this->tableGateway->updateWith($update);
    }

}
