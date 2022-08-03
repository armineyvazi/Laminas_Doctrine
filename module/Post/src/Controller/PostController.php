<?php



namespace Post\Controller;

use Post\Entity\Post;
use Post\Form\PostForm;
use Post\Service\PostManager;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;
use Masterminds\HTML5\Exception;

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
                $this->postManager->createPost($data);
                $this->flashMessenger()->addSuccessMessage('Album created successfully.');
                return $this->redirect()->toRoute('post');
            }
        }
        return new ViewModel(\compact('form'));
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        $this->postManager->deletePost($id);

        return $this->redirect()->toRoute('post');
    }

    public function editAction()
    {
        $form = new PostForm;
        $id = $this->params()->fromRoute('id');

        if ($this->getRequest()->isGet()) {
            $post = $this->postManager->find($id);
            $form->bind($post);

            return new ViewModel(\compact('form', 'post'));
        }
        else if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if (!$form->isValid()) {
                throw new Exception('nist aqa nist');
            }
            $data = $form->getData();
            $this->postManager->editPost($id, $data);

            return $this->redirect()->toRoute('post');
        }
    }

}