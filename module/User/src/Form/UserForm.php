<?php

namespace User\Form;

use Laminas\Form\Form;

class UserForm extends Form
{

    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('user');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'firstname',
            'type' => 'text',
            'options' => [
                'label' => 'Firstname',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your Firstname',
            ]
        ]);
        $this->add([
            'name' => 'lastname',
            'type' => 'text',
            'options' => [
                'label' => 'Lastname',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your lastname',
            ]
        ]);
        $this->add([
            'name' => 'email',
            'type' => 'email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your email',
            ]
        ]);
        $this->add([
            'name' => 'password',
            'type' => 'password',
            'options' => [
                'label' => 'password',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your password',
            ]
        ]);
        $this->add([
            'name' => 'confirmpassword',
            'type' => 'password',
            'options' => [
                'label' => 'passwordconfirm',
            ],
            'attributes' => [
                'class' => 'form-control', #styli
                'size' => 40,
                'maxlength' => 25,
                'title' => 'Username must consict of alphanumeric Charectors only',
                'placeholder' => 'Enter Your confirmpassword',
            ]
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id' => 'submitbutton',
            ],
        ]);
    }

}