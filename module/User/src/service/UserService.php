<?php


namespace User\Service;

use User\Model\User;
use User\Form\UserForm;



class UserService
{

    public function createUser($data)
    {
        $this->table->saveUser($data);
    }


}