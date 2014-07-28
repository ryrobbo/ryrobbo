<?php

namespace Blog\Service\Mapper;

class PostCategory {

    public $id;
    public $cid;
    public $pid;
    public $title;
    public $description;
    public $pslug;
    public $published;
    public $posted;
    public $pactive;
    public $category;
    public $cslug;
    public $cactive;

    function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->cid = (isset($data['cid'])) ? $data['cid'] : null;
        $this->pid = (isset($data['pid'])) ? $data['pid'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->pslug = (isset($data['pslug'])) ? $data['pslug'] : null;
        $this->published = (isset($data['published'])) ? $data['published'] : null;
        $this->posted = (isset($data['posted'])) ? $data['posted'] : null;
        $this->pactive = (isset($data['pactive'])) ? $data['pactive'] : null;
        $this->category = (isset($data['category'])) ? $data['category'] : null;
        $this->cslug = (isset($data['cslug'])) ? $data['cslug'] : null;
        $this->cactive = (isset($data['cactive'])) ? $data['cactive'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
