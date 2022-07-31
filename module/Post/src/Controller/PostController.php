<?php



namespace Post\Controller;

use Post\Entity\Post;
use Post\Form\PostForm;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;

class PostController extends AbstractActionController
{
    protected EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $form = new PostForm;
        $posts = $this->entityManager->getRepository(Post::class)->findAll();
        return new ViewModel(\compact('form', 'posts'));
    }

    public function addAction()
    {
        $form = new PostForm;
        $request = $this->getRequest();

        if (!$request->isPost())
            return \compact('form');


        if($this->getRequest()->isPost())
        {
            $data=$this->params()->PostForm();
            dd($data);
        }
        $post=new Post();

        //$post->setInputFilter($post->getInputFilter());
        $form->get('submit')->setValue('Submit');

        dd('a');




        return new ViewModel(['form' => $form]);
    }

    public function deleteAction()
    {

    }

    public function editAction()
    {

    }

}