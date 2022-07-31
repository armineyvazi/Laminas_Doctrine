<?php 

namespace Post\Controller\Factory;

use Interop\Container\ContainerInterface;


interface PostControllerInterface
{
    public function __invoke(ContainerInterface $container,$requestedName, array $options = null);     
}