<?php

namespace User\Controller;

use User\Model\User;
use User\Form\UserForm;
use Laminas\Crypt\Password\Bcrypt;
use User\Model\UserTable;
use Laminas\View\Model\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;
use User\Service\UserService;

class UserController extends AbstractActionController
{

    protected $table;

    protected $userService;


    public function __construct(UserTable $table)
    {
        $this->table = $table;
    }

    public function addAction()
    {
        $form = new UserForm();

        $user = new User();

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {

            return ['form' => $form];
        }
        $form->setInputFilter($user->getInputFilter());

        $form->setData($request->getPost());

        if (!$form->isValid()) {

            return ['form' => $form];
        }

        $user->exchangeArray($form->getData());

        $this->table->saveUser($user);

        return $this->redirect()->toRoute('user');

    }
}