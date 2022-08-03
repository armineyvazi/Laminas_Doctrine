<?php

namespace Post\Service;


use Doctrine\ORM\EntityManager;
use Post\Entity\Post;
use Masterminds\HTML5\Exception;

class PostManager
{
    protected EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createPost(array $data)
    {
        $post = new Post;

        $post->setTitle($data['title']);
        $post->setCategory($data['category']);
        $post->setDescription($data['description']);
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }

    public function deletePost(int $id)
    {
        $post=$this->entityManager->find(Post::class,$id);
        if(!is_null($post))
        { 
            $this->entityManager->remove($post);
            $this->entityManager->flush();

            return true;
        }
        else
            throw new Exception('not found');
    }
    public function find($id)
    {
        $post=$this->entityManager->find(Post::class,$id);
        
        return $post ?? false;
    }
    public function editPost($id,$data)
    {
        // dd($id);
        $post=$this->find($id);
        // dd('2');
        if($post)
        {
            $post->setId($data['id']);
            $post->setTitle($data['title']);
            $post->setCategory($data['category']);
            $post->setDescription($data['description']);
            $this->entityManager->flush();
        }
    
        
    }





}