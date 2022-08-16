<?php


namespace Post\Service\Factory;


use Laminas\ServiceManager\Factory\FactoryInterface;
use Post\Entity\Service\PostModelService;
use Post\Service\PostManager;

class PostManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container)
    {
        // Create an instance of the class.
        $postModelService = $container->get(PostModelService::class);
        return new PostManager($postModelService);
    }


}