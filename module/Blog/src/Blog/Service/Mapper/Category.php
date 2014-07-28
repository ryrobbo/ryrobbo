<?php

namespace Blog\Service\Mapper;

class Category {

    public $id;
    public $category;
    public $slug;
    public $active;

    function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->category = (isset($data['category'])) ? $data['category'] : null;
        $this->slug = (isset($data['slug'])) ? $data['slug'] : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
    }
    
    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
