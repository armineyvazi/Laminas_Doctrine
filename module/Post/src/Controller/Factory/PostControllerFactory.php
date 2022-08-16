<?php

namespace Post\Controller\Factory;

use Post\Service\PostManager;
use Post\Controller\PostController;
use Interop\Container\ContainerInterface;


class PostControllerFactory implements PostControllerInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Create an instance of the class.
        $postManger=$container->get(PostManager::class);
        return new PostController($postManger);

    }
}