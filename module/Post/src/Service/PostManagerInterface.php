<?php 


namespace Post\Service;
use Doctrine\ORM\EntityManager;
use Post\Entity\Service\PostModelService;

interface PostManagerInterface
{
    public function deletePost(int $id);
    public function find($id);
    public function savePost($id,$data);
    public function getPosts($params=[]);
   
}