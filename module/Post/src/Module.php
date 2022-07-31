<?php

declare(strict_types = 1)
;

namespace Post;

use Laminas\Db\ResultSet\ResultSet;
use Post\Controller\PostController;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
    // public function getServiceConfig()
    // {
    //     return [
    //         'factories' => [
    //             Model\AlbumTable::class => function($container) {
    //                 $tableGateway = $container->get(Model\AlbumTableGateway::class);
    //                 return new Model\AlbumTable($tableGateway);
    //             },
    //             Model\AlbumTableGateway::class => function ($container) {
    //                 $dbAdapter = $container->get(AdapterInterface::class);
    //                 $resultSetPrototype = new ResultSet();
    //                 $resultSetPrototype->setArrayObjectPrototype(new Model\Album());
    //                 return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
    //             },
    //         ],
    //     ];
    // }
    // public function getControllerConfig()
    // {
    //     return [
    //         'factories' => [
    //             Controller\PostController::class => InvokableFactory::class ,  // module.config.php
    //         ],
    //     ];
    // }
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespace' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ],
            ],
        ];
    }
}
