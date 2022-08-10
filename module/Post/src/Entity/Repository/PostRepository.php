<?php 

namespace Post\Entity\Repository;

use Post\Entity\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function getAllPost()
    {
        return $this->getEntityManager()
                ->createQueryBuilder()
                ->select('post.id,post.title,post.category,post.description')
                ->from(Post::class,'post')
                ->where('post.id>=0')
                ->getQuery()
                ->execute();
    }
    public function searchPost($string)
    {
      return $this->getEntityManager()
                ->createQueryBuilder()
                ->select('post')
                ->from(Post::class,'post')
                ->where("post.title LIKE :string")
                ->orWhere("post.category LIKE :string")
                ->orWhere("post.description LIKE :string")
                ->setParameter('string', '%'.$string.'%')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

    }
}