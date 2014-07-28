<?php

namespace Blog\Service\Mapper;

class Page {

    public $id;
    public $name;
    public $title;
    public $slug;
    public $description;
    public $content;
    public $posted;
    public $updated;
    public $published;
    public $onmenu;
    public $order;
    public $template;
    public $active;

    function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->slug = (isset($data['slug'])) ? $data['slug'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->content = (isset($data['content'])) ? $data['content'] : null;
        $this->posted = (isset($data['posted'])) ? $data['posted'] : null;
        $this->updated = (isset($data['updated'])) ? $data['updated'] : null;
        $this->published = (isset($data['published'])) ? $data['published'] : null;
        $this->onmenu = (isset($data['onmenu'])) ? $data['onmenu'] : null;
        $this->order = (isset($data['order'])) ? $data['order'] : null;
        $this->template = (isset($data['template'])) ? $data['template'] : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
    }
    
    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
