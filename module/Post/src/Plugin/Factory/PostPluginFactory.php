<?php

namespace Post\Plugin\Factory;

use Interop\Container\Containerinterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Post\Entity\Service\PostModelService;
use Post\Plugin\PostPlugin;

class PostPluginFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Create an instance of the class.
        $postModelService=$container->get(PostModelService::class);
        return new PostPlugin($postModelService);

    }
}