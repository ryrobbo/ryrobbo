<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class Login {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getValidLogin($user) {
        $row = $this->tableGateway->select(array(
            'email' => $user->email,
            'pwd' => $user->pwd,
            'active' => 1
        ));
        
        if($row->count() > 0) {
            return $row->current();
        } else {
            return false;
        }
    }

}
