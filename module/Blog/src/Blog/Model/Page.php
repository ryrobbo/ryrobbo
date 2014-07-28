<?php

namespace Blog\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class Page {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAllPages() {
        $select = new Select('pages');
        $select->where(array(
            'active' => 1
        ))->order(array(
            'order' => 'ASC'
        ));

        $rowset = $this->tableGateway->selectWith($select);

        if (!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }

    public function getPageBySlug($slug) {
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

    public function getPageById($id) {
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

    public function getMainNav() {
        $select = new Select('pages');

        $select->columns(array(
            'id',
            'name',
            'slug',
        ))->where(array(
            'published' => 1,
            'active' => 1,
            'onmenu' => 1
        ))->order(array(
            'order' => 'ASC'
        ));

        $rowset = $this->tableGateway->selectWith($select);

        if (!$rowset) {
            return false;
        } else {
            return $rowset;
        }
    }

    public function updatePage($post) {
        return $this->tableGateway->update(array(
                    'name' => $post['name'],
                    'title' => $post['title'],
                    'content' => $post['content'],
                    'published' => $post['published'],
                    'onmenu' => $post['onmenu'],
                    'order' => $post['order'],
                    'template' => $post['template'],
                    'active' => 1,
                    'updated' => date('Y-m-d h:m:s')
                        ), array(
                    'id' => $post['id']
        ));
    }

    public function createPage($post) {
        $this->tableGateway->insert(array(
            'name' => $post['name'],
            'title' => $post['title'],
            'slug' => $this->createSlug($post['title']),
            'content' => $post['content'],
            'published' => $post['published'],
            'onmenu' => $post['onmenu'],
            'order' => $post['order'],
            'template' => $post['template'],
            'active' => 1,
            'updated' => date('Y-m-d h:m:s'),
            'posted' => date('Y-m-d h:m:s')
        ));

        return $this->tableGateway->getLastInsertValue();
    }
    
    public function deletePage($id) {
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
