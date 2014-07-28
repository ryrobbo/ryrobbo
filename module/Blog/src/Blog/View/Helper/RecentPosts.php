<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RecentPosts extends AbstractHelper implements ServiceLocatorAwareInterface {

    protected $sm;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator->getServiceLocator();
    }

    public function getServiceLocator() {
        return $this->sm;
    }

    public function __invoke($count) {
        $posts = $this->getServiceLocator()->get('Post')->getRecentPosts($count);
        
        $html = '';
        
        if($posts->count()) {
            foreach($posts as $post) {
                $html .= '<li><a href="/post/' . $post->slug . '">' . $post->title . '</a></li>';
            }
        } else {
            $html = '<li>No categories</li>';
        }
        return $html;
    }

}
