<?php

namespace Blog\Service\Mapper;

class Post {

    public $id;
    public $title;
    public $slug;
    public $description;
    public $content;
    public $posted;
    public $updated;
    public $published;
    public $active;

    function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->slug = (isset($data['slug'])) ? $data['slug'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->content = (isset($data['content'])) ? $data['content'] : null;
        $this->posted = (isset($data['posted'])) ? $data['posted'] : null;
        $this->updated = (isset($data['updated'])) ? $data['updated'] : null;
        $this->published = (isset($data['published'])) ? $data['published'] : null;
        $this->active = (isset($data['active'])) ? $data['active'] : null;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
