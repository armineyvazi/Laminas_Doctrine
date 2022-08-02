<?php

namespace Post\Service;
 
use Doctrine\ORM\EntityManager;

class PostManager
{
    protected EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    
}