<?php

namespace Post\Service;


use Post\Entity\Post;
use Doctrine\ORM\EntityManager;
use Masterminds\HTML5\Exception;
use Post\Entity\Service\PostModelService;

class PostManager implements PostManagerInterface
{
    protected PostModelService $postModelService;
    /**
     * @return void
     */
    public function __construct(PostModelService $postModelService)
    {
        $this->postModelService = $postModelService;
    }
    /**
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function deletePost(int $id):bool
    {
        $post=$this->postModelService->find(Post::class,$id);
        if(!is_null($post) and $this->postModelService->getPostRepository()->checkRole($id) )
        { 
            $this->postModelService->remove($post);
            $this->postModelService->flush();
            return true;
        }
        else
            throw new Exception('not found');
    }
    /**
     * 
     * @param mixed $id
     * 
     * @return object|false
     */
    public function find($id):object
    {
        $post=$this->postModelService->find(Post::class,$id);
        return $post ?? false;
    }
    /**
     * @param mixed $data
     * 
     * @param mixed $id
     * 
     * @return void
     */
    public function savePost($data,$id=null):void
    {
        $post=new Post;
        if(is_null($id))
        {  
            $post->setTitle($data['title']);
            $post->setCategory($data['category']);
            $post->setDescription($data['description']);
            $this->postModelService->persist($post);
            $this->postModelService->flush();
        }
        else if(!is_null($id) and $this->postModelService->getPostRepository()->checkRole($id)){
            if(strlen($data['title'])>=3)
            {
                $post=$this->find($id);
                $post->setId($data['id']);
                $post->setTitle($data['title']);
                $post->setCategory($data['category']);
                $post->setDescription($data['description']);
                $this->postModelService->flush();
            }
        }
    }
    /**
     * @return mixed
     */
    public function count()
    {
        return $this->postModelService->getPostRepository()->countPost();
    }
    /**
     *          
     * @param array $params
     * 
     * @return mixed
     */
    public function getPosts($params=[])
    {
        return $this->postModelService->getPostRepository()->getPosts($params);
    }
}