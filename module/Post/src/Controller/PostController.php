<?php



namespace Post\Controller;

use Post\Entity\Post;
use Post\Form\PostForm;
use Post\Service\PostManager;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;

class PostController extends AbstractActionController
{
    protected PostManager $postManager;
    protected EntityManager $entityManager;

    public function __construct(EntityManager $entityManager, PostManager $postManager)
    {
        $this->postManager = $postManager;
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $posts = $this->entityManager->getRepository(Post::class)->findAll();
        return new ViewModel(\compact('form', 'posts'));
    }

    public function addAction()
    {
        $form = new PostForm;
  
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                echo '<pre>';
                print_r($data);
            }
            else {     
                
            }
        }
     

        return new ViewModel(compact('form'));
     
    }

    public function deleteAction()
    {

    }

    public function editAction()
    {

    }

}