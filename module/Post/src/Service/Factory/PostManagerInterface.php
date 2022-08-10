<?php 


namespace Post\Service\Factory;
use Doctrine\ORM\EntityManager;
interface PostManagerInterface
{
    public function  __construct(EntityManager $entityManager);
    public function createPost(array $data);
    public function deletePost(int $id);
    public function find($id);
    public function savePost($id,$data);
    public function getAllPost();
    public function searchPost($data);
}