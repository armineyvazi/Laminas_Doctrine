<?php



namespace Post\Controller;


use Post\Form\PostForm;
use Post\Form\SearchForm;
use Post\Service\PostManager;
use Masterminds\HTML5\Exception;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;

class PostController extends AbstractActionController
{
    protected const  PER_PAGE=5;
    /**
     * @var \Post\Service\PostManager $postManager
     */
    protected PostManager $postManager;
    /**
     * @param \Post\Service\PostManager $postManager
     * 
     * @return void
     */
    public function __construct(PostManager $postManager)
    {
        $this->postManager = $postManager;
    }
    
    /**
     * 
     * @return ViewModel
     */
    public function indexAction():ViewModel
    {
        $form = new SearchForm;
        $request = $this->getRequest(); 
        $query = $request->getQuery();    
        if($request->isXmlHttpRequest() || $query->get('showJson') == 1)
        {
            $string = $_POST['search'];


            $params=[
                'search' => true,
                'string' =>$string,
            ];

            $query = $request->getQuery(); 
            $posts = $this->postManager->getPosts($params);
            $count=$posts['count'][0][1];
            $posts['page']=ceil(((int)$count)/self::PER_PAGE);
            $view = new JsonModel($posts); 
            $view->setTerminal(true); 
        }
        else {

            $countResult=$this->postManager->getPosts(['total'=>true]);
            $posts = $this->postManager->getPosts(['search'=>false]);
            $posts['page']=ceil((int)$countResult/self::PER_PAGE);
            $view = new ViewModel(compact('form','posts','countResult')); 
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

    /**
     * @return \Laminas\Http\Response
     */
    public function deleteAction()
    {

        $id = $this->params()->fromRoute('id');
        if($this->postPlugin($id))
        {
            $this->postManager->deletePost($id);
            $this->flashMessenger()->addSuccessMessage('Post Deleted Successfully.');
        }
        else{
            $this->flashMessenger()->addSuccessMessage('Post Deleted  Not Successfully only deleted by admin.');

        }
        return $this->redirect()->toRoute('post');

    }

    /**
     * @return \Laminas\Http\Response
     */
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
