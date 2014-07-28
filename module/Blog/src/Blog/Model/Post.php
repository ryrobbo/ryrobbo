<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class Post {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getPostBySlug($slug) {
        $rowset = $this->tableGateway->select(array(
            'slug' => $slug,
            'published' => 1,
            'active' => 1
        ));

        $row = $rowset->current();

        if (!$row) {
            return false;
        } else {
            return $row;
        }
    }

    public function getPostById($id) {
        $rowset = $this->tableGateway->select(array(
            'id' => $id,
            'active' => 1
        ));

        $row = $rowset->current();

        if (!$row) {
            return false;
        } else {
            return $row;
        }
    }

    public function getRecentPosts($count) {
        // table
        $select = new Select('posts');
        $select->columns(array(
                    'title',
                    'slug',
                ))
                ->where(array(
                    'published' => 1,
                    'active' => 1
                ))
                ->order(array(
                    'posted' => 'DESC'
                ))->limit($count);

        $rowset = $this->tableGateway->selectWith($select);

        if (!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }

    public function getAllPosts() {
        $select = new Select('posts');
        $select->where(array(
            'active' => 1
        ))->order(array(
            'id' => 'DESC'
        ));

        $rowset = $this->tableGateway->selectWith($select);

        if (!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }

    public function createPost($post) {
        $this->tableGateway->insert(array(
            'title' => $post['title'],
            'description' => $post['description'],
            'content' => $post['content'],
            'published' => $post['published'],
            'slug' => $this->createSlug($post['title']),
            'active' => 1,
            'posted' => date('Y-m-d h:m:s'),
            'updated' => date('Y-m-d h:m:s')
        ));
        
        return $this->tableGateway->getLastInsertValue();
    }

    public function updatePost($post) {
        return $this->tableGateway->update(array(
                    'title' => $post['title'],
                    'description' => $post['description'],
                    'content' => $post['content'],
                    'published' => $post['published'],
                    'active' => 1,
                    'updated' => date('Y-m-d h:m:s')
                        ), array(
                    'id' => $post['id']
        ));
    }
    
    public function deletePost($id) {
        $this->tableGateway->update(array(
            'active' => 0
        ), array(
            'id' => $id
        ));
    }

    public function isPost($slug) {
        $select = new Select('posts');
        $select->columns(array(
            'id'
        ))->where(array(
            'published' => 1,
            'active' => 1,
            'slug' => $slug
        ))->limit(1);

        $rowset = $this->tableGateway->selectWith($select);

        if (!$rowset->current()) {
            return false;
        } else {
            return true;
        }
    }

    public function createSlug($title) {
        // make the string lowercase
        $title = strtolower($title);

        // array of bad chars
        $badChars = array('@', '!', '£', '$', '"', '\'', '/', '.', '?', '<', '>', ',', '`', '#', '%', '&', '*', '(', ')', ':');

        // replace bad chars with nothing
        $title = str_replace($badChars, '', $title);

        // replace spaces with hyphens
        $title = str_replace(' ', '-', $title);

        // return trimmed string
        return trim($title);
    }

}
