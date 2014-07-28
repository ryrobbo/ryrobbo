<?php

namespace Blog\Model;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;

class CacheListener extends AbstractListenerAggregate {

    protected $listeners = array();
    protected $cacheService;

    public function __construct(\Zend\Cache\Storage\Adapter\Filesystem $cacheService) {
        $this->cacheService = $cacheService;
    }

    public function attach(EventManagerInterface $events) {
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'getPageCache'), -1000);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'savePageCache'), -10000);
    }

    public function getPageCache(MvcEvent $event) {
        $match = $event->getRouteMatch();

        if (!$match) {
            return;
        }

        if ($match->getParam('pagecache')) {
            $cache = $this->getCacheService();
            $cacheKey = $this->generateCacheName($match);

            $data = $cache->getItem($cacheKey);

            if (null !== $data) {
                $response = $event->getResponse();
                $response->setContent($data);

                return $response;
            }
        }
    }

    public function savePageCache(MvcEvent $event) {
        $match = $event->getRouteMatch();

        if (!$match) {
            return;
        }

        if ($match->getParam('pagecache')) {
            // test if they asked for a valid post
            if ($this->isPost($event, $match->getParam('slug'))) {
                $response = $event->getResponse();
                $data = $response->getContent();

                $cache = $this->getCacheService();
                $cacheKey = $this->generateCacheName($match);
                $cache->setItem($cacheKey, $data);
            }
        }
    }

    protected function isPost($event, $slug) {
        $post = $event->getApplication()->getServiceManager()->get('Post');

        return $post->isPost($slug);
    }

    protected function generateCacheName($match) {
        return 'pagecache_'
                . str_replace('/', '-', $match->getParam('slug'));
    }

    public function getCacheService() {
        return $this->cacheService;
    }

}
