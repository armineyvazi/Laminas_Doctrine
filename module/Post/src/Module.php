<?php

declare(strict_types = 1)
;

namespace Post;

use Laminas\Mvc\MvcEvent;
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
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $app->getEventManager()->attach('render', [$this, 'registerJsonStrategy'], 100);
    }

    /**
     * @param  MvcEvent $e The MvcEvent instance
     * @return void
     */
    public function registerJsonStrategy(MvcEvent $e)
    {
        $app          = $e->getTarget();
        $locator      = $app->getServiceManager();
        $view         = $locator->get('Laminas\View\View');
        $jsonStrategy = $locator->get('ViewJsonStrategy');

        // Attach strategy, which is a listener aggregate, at high priority
        $jsonStrategy->attach($view->getEventManager(), 100);
    }
}
