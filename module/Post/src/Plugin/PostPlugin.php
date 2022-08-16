<?php


declare(strict_types=1);
namespace   Post\Plugin;

use Doctrine\ORM\EntityManager;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Post\Entity\Service\PostModelService;

class PostPlugin extends  AbstractPlugin{

    protected  PostModelService  $postModelService;
    public function  __construct(PostModelService  $postModelService)
    {
        $this->postModelService=$postModelService;
    }
    public function  __invoke(int $id)
    {
        return $this->postModelService->getPostRepository()->checkRole($id);
    }



}