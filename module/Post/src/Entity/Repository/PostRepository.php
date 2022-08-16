<?php 

namespace Post\Entity\Repository;

use Post\Entity\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * PER_PAGR;
     */
    public const PER_PAGE=5;
    /**
     * 
     * @param array $params
     * 
     * 
     * @return array
     */
    public function getPosts(array $params=[])
    {
        $page=isset( $_GET['page'] ) ? (int)( $_GET['page'] ):1;
        $perPage = self::PER_PAGE;
        $start   = ($page-1)*$perPage;
        $query   = $this->allPost();

        if($params['total']==true)
        {
            $query=$query->select('count(post.id)')
                         ->getQuery()->getSingleScalarResult();
        }
        else if($params['search']==false)
        {
            $query=$query
                        ->setFirstResult($start)
                        ->setMaxResults($perPage)
                        ->getQuery()
                        ->getResult();

        }
        else if($params['search']==true)
        {

            $string=$params['string'];
            $query= $query
                ->where("post.title LIKE :string")
                ->orWhere("post.category LIKE :string")
                ->orWhere("post.description LIKE :string")
                ->setParameter('string', '%'.$string.'%')
                ->getQuery()
                ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

            $count=$this->allPost();
            $query['count']= $count
                ->select('count(post.id)')
                ->where("post.title LIKE :string")
                ->orWhere("post.category LIKE :string")
                ->orWhere("post.description LIKE :string")
                ->setParameter('string', '%'.$string.'%')->getQuery()->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }

        return $query;
    }
    public function flush()
    {
        return $this->getEntityManager()->flush();
    }
    public function persist($data)
    {
        return $this->getEntityManager()->persist($data);
    }
    public function remove($data)
    {
      return $this->getEntityManager()->remove($data);
    }
    public function  checkRole($id): int
    {
        return (int) $this->getEntityManager()
                           ->createQueryBuilder()
                           ->select('post.role')
                           ->from(Post::class,'post')
                           ->where("post.id=$id")
                           ->getQuery()->getSingleScalarResult();
    }
    public function  count($query)
    {
        return $query->select('count(post.id)')
                     ->getQuery()->getSingleScalarResult();
    }
    public function  allPost()
    {
        return $this->getEntityManager()
                    ->createQueryBuilder()
                    ->select('post.id,post.title,post.category,post.description,post.role')
                    ->from(Post::class,'post')
                    ->where('post.id>=0');
    }

}