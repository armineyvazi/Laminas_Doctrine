<?php 


namespace Post\Entity\Service;

use Doctrine\ORM\Decorator\EntityManagerDecorator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Post\Entity\Post;


class PostModelService extends EntityManagerDecorator
{
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
    }

    public function getPostRepository()
    {
        return $this->getRepository(Post::class);
    }

}