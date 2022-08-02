<?php


namespace Post\Service\Factory;

use Post\Service\PostManager;
use Interop\Container\ContainerInterface;


class PostMangerFactory
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Create an instance of the class.
        $doctrineConfig = $container->get('doctrine.entitymanager.orm_default');
        return new PostManager($doctrineConfig);
    }



}