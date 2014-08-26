<?php
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=ryrobbo;host=localhost',
        'username' => '',
        'password' => '',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'DbAdapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Cache' => 'Zend\Cache\Service\StorageCacheFactory'
        )
    ),
    'cache' => array(
        'adapter' => 'filesystem',
        'options' => array(
            'cache_dir' => 'data/cache/fullpage'
        )
    ),
    'plugins' => array(
        'exception_handler' => array(
            'throw_exceptions' => false
        )
    )
);
