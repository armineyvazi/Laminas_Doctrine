<?php

namespace Post\Service;


use Doctrine\ORM\EntityManager;
use Exception as GlobalException;
use Post\Entity\Post;
use Masterminds\HTML5\Exception;
use Post\Service\Factory\PostManagerInterface;

class PostManager implements PostManagerInterface
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
    public function savePost($data,$id=null)
    {
        $post=new Post;
        if($id==null)
        {  
            $post->setTitle($data['title']);
            $post->setCategory($data['category']);
            $post->setDescription($data['description']);
            $this->entityManager->persist($post);
            $this->entityManager->flush();
        }
        else{
            if(strlen($data['title'])>=3)
            {
                $post=$this->find($id);
                $post->setId($data['id']);
                $post->setTitle($data['title']);
                $post->setCategory($data['category']);
                $post->setDescription($data['description']);
                $this->entityManager->flush();
            }
        }
    }
    public function getAllPost()
    {
        return $this->entityManager->getRepository(Post::class)->getAllPost();
    }

    public function searchPost($data)
    {
        return $this->entityManager->getRepository(Post::class)->searchPost($data);
    }
    public function paginate()
    {
        
    }
}