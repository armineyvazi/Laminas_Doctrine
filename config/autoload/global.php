<?php


use Doctrine\DBAL\Driver\PDO\MySQL\Driver;

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
      'doctrine' => [
         'connection' => [
            'orm_default' => [
               'driverClass' => Driver::class,
                  'params' => [
                     'host'     => '127.0.0.1',                    
                     'user'     => 'root',
                     'password' => '1111',
                     'dbname'   => 'album',
                  ]
               ],            
            ],        
      ],
    'db' => [
      'driver'   => 'Pdo',
      'dsn'      => 'mysql:dbname=album;host=localhost;charset=utf8',
      'username' => 'root',
      'password' => '1111',
    ],
     'service_manager' => array(
        'factories' => array(
           'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
     ),

];
