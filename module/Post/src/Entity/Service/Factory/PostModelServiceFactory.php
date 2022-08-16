<?php 

namespace Post\Entity\Service\Factory;


use Doctrine\ORM\EntityManager;
use Post\Entity\Service\PostModelService;

class PostModelServiceFactory implements \Laminas\ServiceManager\Factory\FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        // Create an instance of the class.
        return new PostModelService( $container->get(EntityManager::class));
    }
}