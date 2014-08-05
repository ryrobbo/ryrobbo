<?php

namespace Admin\Service\Invokable;

use Zend\Session\Container;

class AdminSession extends Container {
    public function __construct() {
        parent::__construct('admin');
    }
    
    public function setLoggedIn($user) {
        $this->offsetSet('user', $user);
    }
    
    public function isLoggedIn() {
        return $this->offsetExists('user');
    }
}
