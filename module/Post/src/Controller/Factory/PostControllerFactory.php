<?php

namespace Post\Controller\Factory;

use Post\Controller\PostController;
use Interop\Container\ContainerInterface;


class PostControllerFactory implements PostControllerInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Create an instance of the class.
        $doctrineConfig = $container->get('doctrine.entitymanager.orm_default');
        return new PostController($doctrineConfig);

    }
}