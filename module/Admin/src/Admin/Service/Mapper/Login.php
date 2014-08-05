<?php

namespace Admin\Service\Mapper;

class Login {

    public $id;
    public $fullname;
    public $email;
    public $pwd;
    public $active;

    function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->fullname = (isset($data['fullname'])) ? $data['fullname'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->pwd = (isset($data['pwd'])) ? $this->hashPassword($data['pwd']) : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
    }
    
    public function getArrayCopy() {
        return get_object_vars($this);
    }
    
    public function hashPassword($plain) {
        return hash_hmac('SHA256', $plain, 'Sheeeiiit%');
    }

}
