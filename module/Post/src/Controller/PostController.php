<?php



namespace Post\Controller;


use Post\Form\PostForm;
use Post\Form\SearchForm;
use Post\Service\PostManager;
use Doctrine\ORM\EntityManager;
use Masterminds\HTML5\Exception;
use Laminas\View\Model\JsonModel;
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
        $form = new SearchForm;
        $posts= $this->postManager->getAllPost();
        $request = $this->getRequest(); 
        $query = $request->getQuery();    
        if($request->isXmlHttpRequest() || $query->get('showJson') == 1)
        {
            $query = $request->getQuery(); 
            $jsonData=[];
            $count=0;
            $search = $_POST['search'];
            $posts = $this->postManager->searchPost($search);
            $view = new JsonModel($posts); 
            $view->setTerminal(true); 
        }
        else { 
            $posts = $this->postManager->getAllPost();
            $view = new ViewModel(compact('form','posts')); 
        }   
       return $view;
    }
    public function addAction()
    {
        $form = new PostForm;
        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if ($form->isValid()) {
                $data = $form->getData();
                $this->postManager->savePost($data);
                $this->flashMessenger()->addSuccessMessage('Post Created Successfully.');
                return $this->redirect()->toRoute('post');
            }
        }
        return new ViewModel(\compact('form'));
    }
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $this->postManager->deletePost($id);
        $this->flashMessenger()->addSuccessMessage('Post Deleted Successfully.');
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
        } else if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            if (!$form->isValid()) {

                throw new Exception('nist aqa nist');
            }
            $data = $form->getData();
            $this->postManager->savePost( $data,$id);
            $this->flashMessenger()->addSuccessMessage('Post Edited Successfully.');
            return $this->redirect()->toRoute('post');
        }
    }   
}
